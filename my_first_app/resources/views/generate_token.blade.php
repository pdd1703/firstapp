<!DOCTYPE html>
<html>
<head>
    <title>Token Generator</title>
</head>
<body>
    <h1>Generate Token</h1>
    <button id="generateButton">Generate Token</button>
    <div id="tokenContainer"></div>

    <script>
        document.getElementById('generateButton').addEventListener('click', function () {
            // Gửi yêu cầu AJAX đến máy chủ để tạo mã token
            fetch('/api/generate-token')
                .then(response => response.json())
                .then(data => {
                    // Hiển thị mã token trên trang web
                    document.getElementById('tokenContainer').innerText = data.token;
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
</body>
</html>
