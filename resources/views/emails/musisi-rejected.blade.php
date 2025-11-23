@php
    /** @var \App\Models\Musisi $musisi */
    $user = $musisi->user;
@endphp
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pendaftaran Musisi Ditolak</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body
    style="margin:0;padding:0;background-color:#f3f4f6;font-family:system-ui,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0"
        style="background-color:#f3f4f6;padding:24px 0;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0"
                    style="max-width:600px;background-color:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 20px 25px -5px rgba(15,23,42,0.08);">
                    {{-- HEADER --}}
                    <tr>
                        <td
                            style="padding:24px 24px 20px;background:linear-gradient(135deg,#0f172a,#6b7280);color:#e5e7eb;">
                            <table width="100%">
                                <tr>
                                    <td style="text-align:left;">
                                        <div
                                            style="font-size:20px;font-weight:700;letter-spacing:0.04em;text-transform:uppercase;">
                                            Sumber Suara
                                        </div>
                                        <div style="margin-top:6px;font-size:13px;color:#d1d5db;">
                                            Local Pasti Vocal • Komunitas Musik Lampung
                                        </div>
                                    </td>
                                    <td style="text-align:right;vertical-align:top;">
                                        <span
                                            style="display:inline-block;padding:4px 10px;border-radius:9999px;background-color:rgba(15,23,42,0.75);font-size:11px;font-weight:600;color:#e5e7eb;">
                                            Pendaftaran Ditolak
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- garis dekor --}}
                    <tr>
                        <td>
                            <div style="height:4px;background:linear-gradient(to right,#ef4444,#f97316,#eab308);"></div>
                        </td>
                    </tr>

                    {{-- BODY --}}
                    <tr>
                        <td style="padding:24px 24px 8px;">
                            <p style="margin:0 0 12px;font-size:14px;color:#4b5563;">
                                Halo <strong style="color:#111827;">{{ $user?->nama ?? 'Musisi' }}</strong>,
                            </p>

                            <p style="margin:0 0 12px;font-size:14px;color:#4b5563;line-height:1.6;">
                                Terima kasih telah mendaftar sebagai <strong>musisi</strong> di platform
                                <strong>Sumber Suara</strong>.
                            </p>

                            <div
                                style="margin:16px 0;padding:14px 16px;border-radius:12px;background-color:#fef2f2;border:1px solid #fee2e2;">
                                <div style="font-size:13px;font-weight:600;color:#b91c1c;margin-bottom:4px;">
                                    Status Pendaftaran
                                </div>
                                <div style="font-size:13px;color:#7f1d1d;line-height:1.6;">
                                    Setelah melalui proses peninjauan, kami mohon maaf bahwa
                                    <strong>pendaftaran Anda belum dapat kami setujui</strong> saat ini.
                                </div>
                            </div>

                            <p style="margin:0 0 12px;font-size:14px;color:#4b5563;line-height:1.6;">
                                Beberapa kemungkinan alasan penolakan dapat meliputi:
                            </p>

                            <ul style="margin:0 0 16px 18px;padding:0;font-size:13px;color:#4b5563;line-height:1.6;">
                                <li>Data yang diisi belum lengkap atau kurang sesuai</li>
                                <li>File lagu original tidak memenuhi kriteria yang ditentukan</li>
                                <li>Terjadi ketidaksesuaian antara identitas dan konten yang dikirimkan</li>
                            </ul>

                            <p style="margin:0 0 14px;font-size:14px;color:#4b5563;line-height:1.6;">
                                Jika Anda merasa terjadi kesalahan atau ingin mengajukan kembali di kemudian hari,
                                Anda dapat:
                            </p>

                            <ul style="margin:0 0 18px 18px;padding:0;font-size:13px;color:#4b5563;line-height:1.6;">
                                <li>Menyiapkan ulang materi dan data pendaftaran dengan lebih lengkap</li>
                                <li>Menghubungi Admin Sumber Suara untuk informasi lebih lanjut</li>
                            </ul>

                            <p style="margin:0 0 0;font-size:13px;color:#6b7280;line-height:1.6;">
                                Kami tetap mengapresiasi semangat dan karya yang Anda buat.
                                Semoga kita tetap bisa berkolaborasi di kesempatan berikutnya 🙏
                            </p>
                        </td>
                    </tr>

                    {{-- FOOTER --}}
                    <tr>
                        <td style="padding:16px 24px 20px;background-color:#f9fafb;border-top:1px solid #e5e7eb;">
                            <p style="margin:0 0 4px;font-size:12px;color:#6b7280;">
                                Salam hangat,<br>
                                <span style="font-weight:600;color:#111827;">Tim Sumber Suara</span>
                            </p>
                            <p style="margin:4px 0 0;font-size:11px;color:#9ca3af;">
                                Email ini dikirim secara otomatis. Jika Anda membutuhkan bantuan,
                                silakan hubungi Admin melalui kontak resmi Sumber Suara.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
