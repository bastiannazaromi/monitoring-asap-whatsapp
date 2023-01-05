<!DOCTYPE html>
<html>

<head>
    <title></title>
    <style type="text/css">
        #table {
            font-family: sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #table td,
        #table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #table tr:hover {
            background-color: #ddd;
        }

        #table th {
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: left;
            background-color: #4caf50;
            color: white;
        }

        hr.solid {
            border-top: 3px solid black;
        }
    </style>
</head>

<body>
    <h2 style="text-align: center">Data PC Laboratorium RPL</h2><br>
    <hr class="solid">
    <table id="table">
        <tr>
            <th>No</th>
            <th>Kadar Asap</th>
            <th>Waktu</th>
        </tr>
        <?php $i = 1;
        foreach ($asap as $data) : ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= $data['nilai']; ?></td>
                <td><?= $data['waktu']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>