@php
    /** @var \App\Models\User $user */
    $user = $user ?? null;
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Selamat Datang di Sumber Suara</title>
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
                        <td style="padding:24px 24px 20px;background:linear-gradient(135deg,#1d4ed8,#0f172a);color:#e5e7eb;">
                            <table width="100%">
                                <tr>
                                    <td style="text-align:left;">
                                        <div
                                            style="font-size:20px;font-weight:700;letter-spacing:0.04em;text-transform:uppercase;">
                                            Sumber Suara
                                        </div>
                                        <div style="margin-top:6px;font-size:13px;color:#cbd5f5;">
                                            Local Pasti Vocal • Komunitas Musik Lampung
                                        </div>
                                    </td>
                                    <td style="text-align:right;vertical-align:top;">
                                        <span
                                            style="display:inline-block;padding:4px 10px;border-radius:9999px;background-color:rgba(15,23,42,0.65);font-size:11px;font-weight:600;color:#e5e7eb;">
                                            Akun Audiens Aktif
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- garis dekor --}}
                    <tr>
                        <td>
                            <div style="height:4px;background:linear-gradient(to right,#3b82f6,#22c55e,#eab308);"></div>
                        </td>
                    </tr>

                    {{-- BODY --}}
                    <tr>
                        <td style="padding:24px 24px 8px;">
                            <p style="margin:0 0 12px;font-size:14px;color:#4b5563;">
                                Halo <strong style="color:#111827;">{{ $user?->nama ?? 'Sahabat Musik' }}</strong>,
                            </p>

                            <p style="margin:0 0 12px;font-size:14px;color:#4b5563;line-height:1.6;">
                                Terima kasih telah bergabung sebagai <strong>Audiens</strong> di
                                <strong>Sumber Suara</strong> 🎧.
                                Akun kamu sudah <strong style="color:#16a34a;">aktif</strong> dan siap digunakan
                                untuk menikmati karya musisi lokal Lampung.
                            </p>

                            <div
                                style="margin:18px 0;padding:14px 16px;border-radius:12px;background-color:#eff6ff;border:1px solid #dbeafe;">
                                <div style="font-size:13px;font-weight:600;color:#1d4ed8;margin-bottom:4px;">
                                    Detail Akun
                                </div>
                                <div style="font-size:13px;color:#4b5563;line-height:1.5;">
                                    <div><strong>Email:</strong> {{ $user?->email }}</div>
                                    @isset($umur)
                                        <div><strong>Perkiraan Umur:</strong> {{ $umur }} tahun</div>
                                    @endisset
                                    @isset($jenisKelaminLabel)
                                        <div><strong>Jenis Kelamin:</strong> {{ $jenisKelaminLabel }}</div>
                                    @endisset
                                    <div>
                                        <strong>Status Akun:</strong>
                                        <span style="color:#16a34a;font-weight:600;">Aktif</span>
                                    </div>
                                </div>
                            </div>

                            <p style="margin:0 0 16px;font-size:14px;color:#4b5563;line-height:1.6;">
                                Sebagai Audiens, kamu bisa:
                            </p>

                            <ul style="margin:0 0 18px 18px;padding:0;font-size:13px;color:#4b5563;line-height:1.6;">
                                <li>Mendengarkan rilisan musik dari musisi lokal Lampung</li>
                                <li>Memberi dukungan melalui fitur <em>like</em> / lagu favorit</li>
                                <li>Ikut serta dalam event dan aktivitas komunitas</li>
                            </ul>

                            <div style="text-align:center;margin:22px 0 8px;">
                                <a href="{{ url('/') }}"
                                   style="display:inline-block;padding:10px 22px;border-radius:9999px;background:linear-gradient(135deg,#1d4ed8,#2563eb);color:#f9fafb;font-size:13px;font-weight:600;text-decoration:none;box-shadow:0 10px 15px -3px rgba(37,99,235,0.45);">
                                    Mulai Jelajahi Sumber Suara
                                </a>
                            </div>

                            <p style="margin:18px 0 0;font-size:12px;color:#9ca3af;line-height:1.6;">
                                Jika kamu merasa tidak pernah mendaftar, silakan abaikan email ini
                                atau hubungi Admin Sumber Suara.
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
                                Email ini dikirim secara otomatis. Mohon tidak membalas langsung ke alamat email ini.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
