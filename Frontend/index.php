<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kurdish Cuisine</title>
</head>
<body>
    <script>
        fetch('http://localhost/Kurdish%20Cuisine%20Web/Backend/', {
            method: 'POST',
            credentials: 'include', // Ensures cookies or other credentials are included
            headers: {
                'Content-Type': 'application/json', // Backend should expect JSON data
            },
            body: JSON.stringify({ key: '$2y$16$sMoj1Q4daRDZOjiTRGULN.5fLi62W93sfVhbWBrMKFMFdB1mt4wRm' }), // Send JSON data
            })
            .then((res) => {
                if (!res.ok) {
                throw new Error(`HTTP error! status: ${res.status}`);
                }
                return res.json();
            })
            .then((data) => {
                console.log(data);
            })
            .catch((error) => {
                console.error('Error:', error);
        });
        fetch('http://localhost/Kurdish%20Cuisine%20Web/Backend/', {
            method: 'POST',
            credentials: 'include', // Ensures cookies or other credentials are included
            headers: {
                'Content-Type': 'application/json', // Backend should expect JSON data
            },
            body: JSON.stringify({ key: '$2y$16$JOb9TSWZzBXcw2hdK45AVeTYlfIIa2f2gYWrqq9ZDWUQN0BQOPOmO' }), // Send JSON data
            })
            .then((res) => {
                if (!res.ok) {
                throw new Error(`HTTP error! status: ${res.status}`);
                }
                return res.json();
            })
            .then((data) => {
                console.log(data);
            })
            .catch((error) => {
                console.error('Error:', error);
        });
        fetch('http://localhost/Kurdish%20Cuisine%20Web/Backend/', {
            method: 'POST',
            credentials: 'include', // Ensures cookies or other credentials are included
            headers: {
                'Content-Type': 'application/json', // Backend should expect JSON data
            },
            body: JSON.stringify({ key: '$2y$16$Jso8f58Rm0pVfrChNbK2mOZph3DpP7wFLSxA7OJPPhanRLywN.Gfe', Username: "Bastory"}), // Send JSON data
            })
            .then((res) => {
                if (!res.ok) {
                throw new Error(`HTTP error! status: ${res.status}`);
                }
                return res.json();
            })
            .then((data) => {
                console.log(data);
            })
            .catch((error) => {
                console.error('Error:', error);
        });
    </script>
</body>
</html>