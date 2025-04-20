<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Certificat - Sersif Academy</title>
    <style>
        @page {
            margin: 0;
            size: a4 landscape;
        }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
            color: #333;
        }
        .certificate-container {
            width: 1100px;
            height: 770px;
            margin: 0 auto;
            position: relative;
            background-color: #fff;
        }
        .certificate-border {
            position: absolute;
            top: 20px;
            left: 20px;
            right: 20px;
            bottom: 20px;
            border: 2px solid #c49a6c;
            border-radius: 5px;
        }
        .certificate-inner-border {
            position: absolute;
            top: 30px;
            left: 30px;
            right: 30px;
            bottom: 30px;
            border: 1px solid #c49a6c;
            border-radius: 3px;
        }
        .certificate-content {
            padding: 60px;
            text-align: center;
            position: relative;
            z-index: 1;
        }
        .logo {
            margin-bottom: 20px;
            text-align: center;
        }
        .logo img {
            max-width: 180px;
            max-height: 80px;
        }
        .certificate-header {
            margin-bottom: 10px;
        }
        .certificate-title {
            font-size: 42px;
            font-weight: 700;
            text-transform: uppercase;
            color: #333;
            margin: 10px 0;
            letter-spacing: 4px;
        }
        .certificate-subtitle {
            font-size: 22px;
            color: #555;
            margin: 10px 0 30px;
            font-weight: 300;
        }
        .student-name {
            font-size: 32px;
            font-weight: 700;
            color: #c49a6c;
            margin: 20px 0;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        .certificate-text {
            font-size: 18px;
            line-height: 1.6;
            margin: 20px 0;
        }
        .course-name {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin: 15px 0;
            padding: 15px;
            border-top: 1px solid #eee;
            border-bottom: 1px solid #eee;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }
        .certificate-footer {
            margin-top: 60px;
            display: flex;
            justify-content: space-between;
            padding: 0 100px;
        }
        .signature {
            text-align: center;
            flex: 1;
        }
        .signature-line {
            border-top: 1px solid #333;
            width: 200px;
            margin: 15px auto 5px;
        }
        .signature-name {
            font-weight: bold;
            font-size: 16px;
        }
        .signature-title {
            font-size: 14px;
            color: #666;
        }
        .certificate-date {
            margin-top: 20px;
            font-size: 16px;
            color: #666;
            font-style: italic;
        }
        .certificate-id {
            position: absolute;
            bottom: 20px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 12px;
            color: #999;
        }
        .corner-decoration {
            position: absolute;
            width: 80px;
            height: 80px;
            z-index: 0;
        }
        .corner-decoration.top-left {
            top: 40px;
            left: 40px;
            border-top: 3px solid #c49a6c;
            border-left: 3px solid #c49a6c;
        }
        .corner-decoration.top-right {
            top: 40px;
            right: 40px;
            border-top: 3px solid #c49a6c;
            border-right: 3px solid #c49a6c;
        }
        .corner-decoration.bottom-left {
            bottom: 40px;
            left: 40px;
            border-bottom: 3px solid #c49a6c;
            border-left: 3px solid #c49a6c;
        }
        .corner-decoration.bottom-right {
            bottom: 40px;
            right: 40px;
            border-bottom: 3px solid #c49a6c;
            border-right: 3px solid #c49a6c;
        }
        .certificate-seal {
            position: absolute;
            bottom: 100px;
            right: 80px;
            width: 120px;
            height: 120px;
            opacity: 0.7;
            transform: rotate(-15deg);
        }
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 100px;
            color: rgba(196, 154, 108, 0.07);
            z-index: 0;
            font-weight: bold;
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <div class="certificate-container">
        <div class="certificate-border"></div>
        <div class="certificate-inner-border"></div>
        
        <div class="corner-decoration top-left"></div>
        <div class="corner-decoration top-right"></div>
        <div class="corner-decoration bottom-left"></div>
        <div class="corner-decoration bottom-right"></div>
        
        <div class="watermark">SERSIF ACADEMY</div>
        
        <div class="certificate-content">
            <div class="logo">
                <!-- Si vous avez un logo, vous pouvez l'ajouter ici -->
                <h1 style="font-size: 28px; font-weight: 700; margin: 0; color: #c49a6c;">SERSIF ACADEMY</h1>
            </div>
            
            <div class="certificate-header">
                <div class="certificate-title">Certificat de Réussite</div>
                <div class="certificate-subtitle">Ce certificat atteste officiellement que</div>
            </div>
            
            <div class="student-name">
                {{ isset($etudiant->user->name) ? $etudiant->user->name : 'Nom non disponible' }}
            </div>
            
            
            <div class="certificate-text">
                a complété avec succès toutes les exigences et a démontré une 
                maîtrise exceptionnelle des compétences requises pour le cours suivant :
            </div>
            
            <div class="course-name">{{ $cours->titre }}</div>
            
            <div class="certificate-footer">
                <div class="signature">
                    <div class="signature-line"></div>
                    <div class="signature-name">Dr. SERSIF RACHID</div>
                    <div class="signature-title">Directeur Académique</div>
                </div>
                
                <div class="signature">
                    <div class="signature-line"></div>
                    <div class="signature-name">Prof. SERSIF ZOUHIR</div>
                    <div class="signature-title">Responsable Pédagogique</div>
                </div>
            </div>
            
            <div class="certificate-date">
                Délivré le : {{ $date }}
            </div>
            
            <div class="certificate-id">
                Certificat ID: SA-{{ str_pad($etudiant->id, 4, '0', STR_PAD_LEFT) }}-{{ str_pad($cours->id, 4, '0', STR_PAD_LEFT) }}-{{ date('Ymd') }}
            </div>
        </div>
        
        <!-- Using SVG directly instead of background-image -->
        <svg class="certificate-seal" xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 120 120">
            <circle cx="60" cy="60" r="58" fill="none" stroke="#c49a6c" stroke-width="2"/>
            <circle cx="60" cy="60" r="52" fill="none" stroke="#c49a6c" stroke-width="1"/>
            <text x="60" y="60" font-family="Arial" font-size="14" text-anchor="middle" fill="#c49a6c">SERSIF ACADEMY</text>
            <text x="60" y="80" font-family="Arial" font-size="12" text-anchor="middle" fill="#c49a6c">OFFICIAL</text>
        </svg>
    </div>
</body>
</html>