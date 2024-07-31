<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    /* Style de la KPI Card */
    .kpi-card {
        background-color: bisque;
        border: dimgray 3px solid;
        border-radius: 5px;
        padding: 15px;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
        margin: 10px;
        width: 250px;
    }

    .kpi-card h3 {
        font-size: 18px;
        color: #333;
        margin-bottom: 10px;
    }

    .info {
        margin-bottom: 8px;
    }

    .label {
        font-weight: bold;
        color: #777;
    }

    .value {
        color: #333;
    }
    </style>
</head>

<body>
    <div class="kpi-card">
        <h3>Informations du Technicien</h3>
        <div class="info">
            <span class="label">Nom:</span>
            <span class="value">John Doe</span>
        </div>
        <div class="info">
            <span class="label">Prénom:</span>
            <span class="value">Jane</span>
        </div>
        <div class="info">
            <span class="label">Âge:</span>
            <span class="value">30 ans</span>
        </div>
    </div>

</body>

</html>