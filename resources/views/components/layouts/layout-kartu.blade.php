<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kartu Ujian</title>
    <style>
        :root {
            --primary-color: #435ebe;
            --secondary-color: #41bbdd;
            --text-color: #333;
            --light-text: #6c757d;
            --card-bg: #fff;
            --body-bg: #f2f7ff;
            --border-radius: 10px;
            --box-shadow: 0 4px 12px rgba(67, 94, 190, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Nunito', 'Segoe UI', Arial, sans-serif;
        }

        body {
            background-color: var(--body-bg);
            color: var(--text-color);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .card-container {
            width: 100%;
            max-width: 800px;
            background-color: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
        }

        .card-header {
            background-color: var(--primary-color);
            color: white;
            padding: 15px 20px;
            text-align: center;
        }

        .card-body {
            padding: 30px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .student-info {
            display: flex;
            gap: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .student-avatar {
            width: 100px;
            height: 100px;
            background-color: var(--secondary-color);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 2rem;
            font-weight: bold;
        }

        .student-details {
            flex-grow: 1;
        }

        .student-name {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .student-id {
            font-size: 0.9rem;
            color: var(--light-text);
            margin-bottom: 5px;
        }

        .exam-details {
            margin-top: 10px;
        }

        .detail-item {
            margin-bottom: 20px;
        }

        .detail-label {
            font-weight: bold;
            margin-bottom: 5px;
            color: var(--primary-color);
        }

        .detail-value {
            padding: 10px 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }

        .card-footer {
            background-color: #f8f9fa;
            padding: 15px 20px;
            text-align: center;
            font-size: 0.85rem;
            color: var(--light-text);
        }

        @media (max-width: 768px) {
            .student-info {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="card-container">
        <div class="card-header">
            <h2>KARTU UJIAN</h2>
        </div>
        <div class="card-body">
            <div class="student-info">
                <div class="student-details">
                    <div class="student-name">{{$user->nama}}</div>
                    <div class="student-id">ID Ujian: {{$user->id}}</div>
                </div>
            </div>

            <div class="exam-details">
                <div class="detail-item">
                    <div class="detail-label">Pilihan 1</div>
                    <div class="detail-value">{{ $user->data->program_studi[0]->nama }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Pilihan 2</div>
                    <div class="detail-value">{{ $user->data->program_studi[1]->nama }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Lokasi Ujian</div>
                    <div class="detail-value">Kampus UNSRIT</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>