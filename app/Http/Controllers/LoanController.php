<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\LoansExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Loan;
use App\Models\Asset;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
{
    if (auth()->user()->role === 'admin') {
        $loans = Loan::with(['user', 'asset'])->latest()->paginate(10);
    } else {
        $loans = Loan::with(['user', 'asset'])->where('user_id', auth()->id())->latest()->paginate(10);
    }
    return view('loans.index', compact('loans'));
}

    public function create()
{
    $assets = Asset::where('status', 'available')
        ->where('kondisi', '!=', 'rusak berat')
        ->get();
    return view('loans.create', compact('assets'));
}

    public function store(Request $request)
{
    $request->validate([
        'asset_id' => 'required|exists:assets,id',
        'tanggal_pinjam' => 'required|date|after_or_equal:today',
        'tanggal_kembali_rencana' => 'required|date|after_or_equal:tanggal_pinjam',
    ]);

    $asset = Asset::findOrFail($request->asset_id);

    if ($asset->status !== 'available') {
        return back()->withErrors(['asset_id' => 'Aset ini sedang tidak tersedia untuk dipinjam.']);
    }

    if ($asset->kondisi === 'rusak berat') {
        return back()->withErrors(['asset_id' => 'Aset dengan kondisi rusak berat tidak dapat dipinjam.']);
    }

    Loan::create([
        'user_id' => auth()->id(),
        'asset_id' => $request->asset_id,
        'tanggal_pinjam' => $request->tanggal_pinjam,
        'tanggal_kembali_rencana' => $request->tanggal_kembali_rencana,
        'status' => 'dipinjam',
    ]);

    Asset::where('id', $request->asset_id)->update(['status' => 'dipinjam']);

    return redirect()->route('loans.index')->with('success', 'Peminjaman berhasil dicatat.');
}

    public function returnAsset(Loan $loan)
    {
        $loan->update([
            'tanggal_kembali_aktual' => now(),
            'status' => 'dikembalikan',
        ]);

        // update status aset balik jadi available
        $loan->asset->update(['status' => 'available']);

        return redirect()->route('loans.index')->with('success', 'Aset berhasil dikembalikan.');
    }

    public function destroy(Loan $loan)
    {
        // kalau loan yang dihapus masih aktif, balikin status aset
        if ($loan->status == 'dipinjam') {
            $loan->asset->update(['status' => 'available']);
        }
        $loan->delete();
        return redirect()->route('loans.index')->with('success', 'Data peminjaman dihapus.');
    }
    public function export()
    {
        return Excel::download(new LoansExport, 'data-peminjaman.xlsx');
    }

    public function printReceipt(Loan $loan)
    {
    $pdf = Pdf::loadView('loans.receipt', compact('loan'));
    return $pdf->stream('bukti-peminjaman-' . $loan->id . '.pdf');
    }
}
