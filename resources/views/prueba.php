
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .resizable {
            overflow: hidden;
            position: relative;
        }

        .resizable table {
            table-layout: fixed;
            border-collapse: collapse;
            width: 100%;
        }

        .resizable th, .resizable td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            white-space: nowrap;
        }

        .resizable th {
            background-color: #f2f2f2;
        }

        .resizable-handle {
            position: absolute;
            height: 100%;
            width: 10px;
            background: #ddd;
            right: 0;
            cursor: ew-resize;
        }
    </style>
</head>
<body>

    <div class="resizable">
        <table>
            <thead>
                <tr>
                    <th>Columna 1</th>
                    <th>Columna 2</th>
                    <th>Columna 3</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Dato 1</td>
                    <td>Dato 2</td>
                    <td>Dato 3</td>
                </tr>
                <tr>
                    <td>Dato 4</td>
                    <td>Dato 5</td>
                    <td>Dato 6</td>
                </tr>
            </tbody>
        </table>
        <div class="resizable-handle"></div>
    </div>

    <!--<script>
        const resizableTable = document.querySelector('.resizable');
        const handle = document.querySelector('.resizable-handle');

        let isResizing = false;
        let initialX;

        handle.addEventListener('mousedown', (e) => {
            isResizing = true;
            initialX = e.clientX;
        });

        document.addEventListener('mousemove', (e) => {
            if (isResizing) {
                const width = e.clientX - initialX;
                const newWidth = resizableTable.offsetWidth + width;

                resizableTable.style.width = `${newWidth}px`;
                initialX = e.clientX;
            }
        });

        document.addEventListener('mouseup', () => {
            isResizing = false;
        });
    </script> !-->

</body>
</html>




<!--
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .resizable {
            overflow: hidden;
            position: relative;
        }

        .resizable-handle {
            position: absolute;
            height: 100%;
            width: 10px;
            background: #ddd;
            right: 0;
            cursor: ew-resize;
        }
    </style>
</head>
<body>

    <div class="resizable">
        <table>
            <thead>
                <tr>
                    <th class="resizable-column">Columna 1</th>
                    <th class="resizable-column">Columna 2</th>
                    <th class="resizable-column">Columna 3</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Dato 1</td>
                    <td>Dato 2</td>
                    <td>Dato 3</td>
                </tr>
                <tr>
                    <td>Dato 4</td>
                    <td>Dato 5</td>
                    <td>Dato 6</td>
                </tr>
            </tbody>
        </table>
        <div class="resizable-handle"></div>
    </div>

    <script>
        const resizableColumns = document.querySelectorAll('.resizable-column');
        const resizableTable = document.querySelector('.resizable');
        const handle = document.querySelector('.resizable-handle');

        let isResizing = false;
        let initialX;

        handle.addEventListener('mousedown', (e) => {
            isResizing = true;
            initialX = e.clientX;
        });

        document.addEventListener('mousemove', (e) => {
            if (isResizing) {
                const width = e.clientX - initialX;
                const newWidth = resizableTable.offsetWidth + width;

                resizableTable.style.width = `${newWidth}px`;
                initialX = e.clientX;
            }
        });

        document.addEventListener('mouseup', () => {
            isResizing = false;
        });
    </script>

</body>
</html>
    !-->