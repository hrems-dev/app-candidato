<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cita Cancelada</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 0;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
            color: white;
            padding: 40px 20px;
            text-align: center;
        }
        .header h1 {
            font-size: 28px;
            margin-bottom: 8px;
        }
        .header p {
            font-size: 14px;
            opacity: 0.9;
        }
        .content {
            padding: 30px 20px;
        }
        .content h2 {
            color: #dc2626;
            margin-bottom: 16px;
            font-size: 22px;
        }
        .greeting {
            margin-bottom: 20px;
            color: #555;
        }
        .details-box {
            background-color: #fef2f2;
            border-left: 4px solid #dc2626;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .detail-row {
            display: flex;
            margin-bottom: 12px;
            font-size: 14px;
        }
        .detail-label {
            font-weight: 600;
            color: #7f1d1d;
            min-width: 120px;
        }
        .detail-value {
            color: #555;
        }
        .razon-box {
            background-color: #fef2f2;
            border: 1px solid #dc2626;
            border-radius: 4px;
            padding: 15px;
            margin: 20px 0;
            color: #7f1d1d;
            font-size: 14px;
        }
        .message {
            background-color: #fef2f2;
            border: 1px solid #dc2626;
            border-radius: 4px;
            padding: 15px;
            margin: 20px 0;
            color: #7f1d1d;
            font-size: 14px;
        }
        .button-container {
            text-align: center;
            margin: 30px 0;
        }
        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 600;
            font-size: 14px;
        }
        .btn:hover {
            opacity: 0.9;
        }
        .footer {
            background-color: #f9fafb;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
            font-size: 12px;
            color: #6b7280;
        }
        .footer a {
            color: #22c55e;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>❌ Cita No Disponible</h1>
            <p>Tu solicitud de asesoría legal ha sido rechazada</p>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="greeting">
                <p>Hola <strong>{{ $cita->nombre }}</strong>,</p>
            </div>

            <h2>Tu cita ha sido cancelada</h2>

            <p>Lamentablemente, tu solicitud de asesoría legal para la fecha solicitada <strong>no ha podido ser confirmada</strong> en esta ocasión.</p>

            <!-- Details -->
            <div class="details-box">
                <div class="detail-row">
                    <span class="detail-label">📅 Fecha Solicitada:</span>
                    <span class="detail-value">{{ \Carbon\Carbon::parse($cita->fecha_cita)->format('d/m/Y H:i') }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">📋 Asunto:</span>
                    <span class="detail-value">{{ $cita->asunto }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">📱 Contacto:</span>
                    <span class="detail-value">{{ $cita->telefono }}</span>
                </div>
            </div>

            @if($razon)
            <div class="razon-box">
                <strong>Motivo del rechazo:</strong><br>
                {{ $razon }}
            </div>
            @endif

            <div class="message">
                <strong>💡 Sugerencia:</strong> Te recomendamos intentar agendar una cita en otra fecha disponible. Estamos aquí para ayudarte.
            </div>

            <div class="button-container">
                <a href="{{ route('citas.create') }}" class="btn">Solicitar Otra Cita</a>
            </div>

            <p style="margin-top: 20px; color: #6b7280; font-size: 14px;">
                Si deseas conocer más sobre nuestros servicios legales o tienes preguntas, no dudes en contactarnos respondiendo a este correo.
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p style="margin-bottom: 8px;">
                <strong>Percy Mamani - Asesor Legal</strong>
            </p>
            <p>Brindando asesoría legal gratuita a la comunidad</p>
            <p style="margin-top: 10px; color: #9ca3af;">
                © {{ date('Y') }} Percy Mamani. Todos los derechos reservados.
            </p>
        </div>
    </div>
</body>
</html>
