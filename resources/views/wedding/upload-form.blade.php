<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Wedding Photos</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            max-width: 60vw;
            width: 100%;
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .header h1 {
            color: #667eea;
            font-size: 2.5em;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .header p {
            color: #666;
            font-size: 1.1em;
        }

        .upload-area {
            border: 3px dashed #667eea;
            border-radius: 15px;
            padding: 40px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #667eea10 0%, #764ba210 100%);
            margin-bottom: 20px;
        }

        .upload-area:hover {
            border-color: #764ba2;
            background: linear-gradient(135deg, #667eea20 0%, #764ba220 100%);
        }

        .upload-area.dragover {
            border-color: #764ba2;
            background: linear-gradient(135deg, #667eea30 0%, #764ba230 100%);
            transform: scale(1.02);
        }

        .upload-area-icon {
            font-size: 3em;
            margin-bottom: 15px;
        }

        .upload-area-text {
            color: #667eea;
            font-size: 1.1em;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .upload-area-subtitle {
            color: #999;
            font-size: 0.95em;
        }

        #photoInput {
            display: none;
        }

        .button-group {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
        }

        button {
            flex: 1;
            padding: 15px;
            border: none;
            border-radius: 10px;
            font-size: 1.05em;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-secondary {
            background: #f0f0f0;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .btn-secondary:hover {
            background: #e8e8e8;
        }

        .preview-section {
            display: none;
            margin-bottom: 20px;
        }

        .preview-section.show {
            display: block;
        }

        .preview-image {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .file-info {
            background: #f5f5f5;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
            font-size: 0.95em;
            color: #666;
        }

        .file-name {
            font-weight: 600;
            color: #333;
            word-break: break-all;
        }

        .alert {
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: none;
            text-align: center;
            font-weight: 500;
        }

        .alert.show {
            display: block;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert-info {
            background: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }

        .loading {
            display: none;
            text-align: center;
            margin: 20px 0;
        }

        .loading.show {
            display: block;
        }

        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #667eea;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 0 auto 15px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .camera-option {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .camera-option button {
            flex: 1;
        }

        .progress-bar {
            width: 100%;
            height: 4px;
            background: #e0e0e0;
            border-radius: 2px;
            margin-bottom: 10px;
            display: none;
        }

        .progress-bar.show {
            display: block;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            border-radius: 2px;
            width: 0%;
            transition: width 0.3s ease;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>📸 Share Your Moment</h1>
            <p>Upload your wedding photos</p>
        </div>

        <div id="alert" class="alert"></div>

        <div class="camera-option">
            <button class="btn-primary" onclick="openCamera()">📷 Take Photo</button>
            <button class="btn-secondary" onclick="selectFile()">🖼️ Choose File</button>
        </div>

        <div class="upload-area" id="uploadArea" onclick="selectFile()">
            <div class="upload-area-icon">📤</div>
            <div class="upload-area-text">Drag & Drop Photo</div>
            <div class="upload-area-subtitle">or click to select from your device</div>
        </div>

        <div class="preview-section" id="previewSection">
            <img id="previewImage" class="preview-image" alt="Preview">
            <div class="file-info">
                <div>File: <span class="file-name" id="fileName"></span></div>
                <div>Size: <span id="fileSize"></span></div>
            </div>
        </div>

        <div class="progress-bar" id="progressBar">
            <div class="progress-fill" id="progressFill"></div>
        </div>

        <div class="loading" id="loading">
            <div class="spinner"></div>
            <span>Uploading your photo...</span>
        </div>

        <button class="btn-primary" id="uploadBtn" style="display: none; width: 100%;" onclick="uploadPhoto()">
            Upload Photo
        </button>

        <div class="button-group" id="actionButtons" style="display: none;">
            <button class="btn-primary" onclick="uploadPhoto()">✓ Upload</button>
            <button class="btn-secondary" onclick="clearSelection()">✕ Clear</button>
        </div>

        <div class="back-link">
            <a href="{{ route('wedding.index') }}">← Back to Wedding Page</a>
        </div>
    </div>

    <div class="d-none" style="display: none;">
        <!-- Hidden camera input -->
        <input type="file" id="photoInput" accept="image/*,video/*" capture="environment">
        <!-- For file selection -->
        <input type="file" id="fileInput" accept="image/*">
    </div>
    <script>
        const uploadArea = document.getElementById('uploadArea');
        const photoInput = document.getElementById('photoInput');
        const fileInput = document.getElementById('fileInput');
        const previewSection = document.getElementById('previewSection');
        const previewImage = document.getElementById('previewImage');
        const fileName = document.getElementById('fileName');
        const fileSize = document.getElementById('fileSize');
        const actionButtons = document.getElementById('actionButtons');
        const uploadBtn = document.getElementById('uploadBtn');
        const alertBox = document.getElementById('alert');
        const loading = document.getElementById('loading');
        const progressBar = document.getElementById('progressBar');
        const progressFill = document.getElementById('progressFill');

        let selectedFile = null;

        // Drag and drop
        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.classList.add('dragover');
        });

        uploadArea.addEventListener('dragleave', () => {
            uploadArea.classList.remove('dragover');
        });

        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('dragover');
            handleFiles(e.dataTransfer.files);
        });

        // File input handlers
        photoInput.addEventListener('change', (e) => {
            handleFiles(e.target.files);
        });

        fileInput.addEventListener('change', (e) => {
            handleFiles(e.target.files);
        });

        function openCamera() {
            photoInput.click();
        }

        function selectFile() {
            fileInput.click();
        }

        function handleFiles(files) {
            if (files.length === 0) return;

            const file = files[0];

            // Validate file
            const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
            if (!validTypes.includes(file.type)) {
                showAlert('Please select a valid image file (JPEG, PNG, or GIF)', 'error');
                return;
            }

            if (file.size > 10 * 1024 * 1024) {
                showAlert('File size must be less than 10MB', 'error');
                return;
            }

            selectedFile = file;

            // Show preview
            const reader = new FileReader();
            reader.onload = (e) => {
                previewImage.src = e.target.result;
                previewSection.classList.add('show');
                fileName.textContent = file.name;
                fileSize.textContent = formatFileSize(file.size);
                actionButtons.style.display = 'flex';
                uploadArea.style.display = 'none';
            };
            reader.readAsDataURL(file);
        }

        function clearSelection() {
            selectedFile = null;
            previewSection.classList.remove('show');
            actionButtons.style.display = 'none';
            uploadArea.style.display = 'block';
            photoInput.value = '';
            fileInput.value = '';
        }

        function uploadPhoto() {
            if (!selectedFile) {
                showAlert('Please select a photo first', 'error');
                return;
            }

            const formData = new FormData();
            formData.append('photo', selectedFile);

            loading.classList.add('show');
            actionButtons.style.display = 'none';
            progressBar.classList.add('show');

            fetch('<?php echo route('wedding.upload') ?>', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    loading.classList.remove('show');
                    progressBar.classList.remove('show');

                    if (data.success) {
                        showAlert('✓ Photo uploaded successfully! It will appear on the wedding page soon.', 'success');
                        clearSelection();
                        previewSection.classList.remove('show');
                        actionButtons.style.display = 'none';
                        uploadArea.style.display = 'block';

                        // Redirect after success
                        setTimeout(() => {
                            window.location.href = '<?php echo route('wedding.index') ?>';
                        }, 2000);
                    } else {
                        showAlert(data.message || 'Failed to upload photo', 'error');
                        actionButtons.style.display = 'flex';
                    }
                })
                .catch(error => {
                    loading.classList.remove('show');
                    progressBar.classList.remove('show');
                    showAlert('Error uploading photo: ' + error.message, 'error');
                    actionButtons.style.display = 'flex';
                });
        }

        function showAlert(message, type) {
            alertBox.textContent = message;
            alertBox.className = `alert show alert-${type}`;
            setTimeout(() => {
                alertBox.classList.remove('show');
            }, 5000);
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
        }

        // Show initial info alert
        showAlert('Select a photo from your device to upload', 'info');
    </script>
</body>

</html>