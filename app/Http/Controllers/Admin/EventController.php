<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ADMIN AREA
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $events = Event::latest()->paginate(10);
        return view('admin.event', compact('events'));
    }

    public function create()
    {
        return view('admin.createEvent');
    }

    public function store(Request $request)
    {
        // VALIDASI + PESAN INDONESIA
        $request->validate($this->rules(), $this->messages());

        $flyerPath = $request->hasFile('flyer')
            ? $request->file('flyer')->store('flyers', 'public')
            : null;

        Event::create([
            'nama_event' => $request->nama_event,
            'lokasi'     => $request->lokasi,
            'tanggal'    => $request->tanggal,
            'deskripsi'  => $request->deskripsi,
            'pengisi'    => $request->pengisi,
            'flyer'      => $flyerPath,
        ]);

        return redirect()->route('admin.event')->with('success', 'Event berhasil ditambahkan.');
    }

    public function edit(Event $event)
    {
        return view('admin.editEvent', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        // VALIDASI + PESAN INDONESIA
        $request->validate($this->rules(), $this->messages());

        $flyerPath = $event->flyer;
        if ($request->hasFile('flyer')) {
            if ($flyerPath) {
                Storage::disk('public')->delete($flyerPath);
            }
            $flyerPath = $request->file('flyer')->store('flyers', 'public');
        }

        $event->update([
            'nama_event' => $request->nama_event,
            'lokasi'     => $request->lokasi,
            'tanggal'    => $request->tanggal,
            'deskripsi'  => $request->deskripsi,
            'pengisi'    => $request->pengisi,
            'flyer'      => $flyerPath,
        ]);

        return redirect()->route('admin.event')->with('success', 'Event berhasil diperbarui.');
    }

    public function destroy(Event $event)
    {
        if ($event->flyer) {
            Storage::disk('public')->delete($event->flyer);
        }
        $event->delete();

        return redirect()->route('admin.event')->with('success', 'Event berhasil dihapus.');
    }

    /*
    |--------------------------------------------------------------------------
    | PUBLIC AREA
    |--------------------------------------------------------------------------
    */
    public function publicIndex()
    {
        $events = Event::latest()->get();
        return view('event', compact('events'));
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('viewEvent', compact('event'));
    }

    /*
    |--------------------------------------------------------------------------
    | RULES & MESSAGES (REUSABLE)
    |--------------------------------------------------------------------------
    */

    /**
     * Aturan validasi untuk create & update event.
     * - flyer: max 5120 KB = 5 MB
     */
    protected function rules(): array
    {
        return [
            'nama_event' => 'required|string|max:255',
            'lokasi'     => 'required|string|max:255',
            'tanggal'    => 'required|date',
            'deskripsi'  => 'nullable|string',
            'pengisi'    => 'nullable|string',
            'flyer'      => 'nullable|image|mimes:jpg,jpeg,png|max:5120', // 5 MB
        ];
    }

    /**
     * Pesan error dalam bahasa Indonesia.
     */
    protected function messages(): array
    {
        return [
            'nama_event.required' => 'Nama event wajib diisi.',
            'nama_event.string'   => 'Nama event harus berupa teks.',
            'nama_event.max'      => 'Nama event maksimal 255 karakter.',

            'lokasi.required' => 'Lokasi event wajib diisi.',
            'lokasi.string'   => 'Lokasi event harus berupa teks.',
            'lokasi.max'      => 'Lokasi event maksimal 255 karakter.',

            'tanggal.required' => 'Tanggal event wajib diisi.',
            'tanggal.date'     => 'Tanggal event harus berupa tanggal yang valid.',

            'deskripsi.string' => 'Deskripsi kegiatan harus berupa teks.',

            'pengisi.string'   => 'Pengisi acara harus berupa teks.',

            'flyer.image' => 'File flyer harus berupa gambar.',
            'flyer.mimes' => 'File flyer harus berformat JPG atau PNG.',
            'flyer.max'   => 'Ukuran file flyer maksimal 5 MB.',
        ];
    }
}
