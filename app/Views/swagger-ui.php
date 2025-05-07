<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Swagger UI</title>
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/swagger-ui-dist@5.11.0/swagger-ui.css">
    <script src="https://unpkg.com/swagger-ui-dist@5.11.0/swagger-ui-bundle.js"></script>
    <script src="https://unpkg.com/swagger-ui-dist@5.11.0/swagger-ui-standalone-preset.js"></script>
</head>
<body>
    <div id="swagger-ui"></div>
    <script>
        window.onload = function() {
            const ui = SwaggerUIBundle({
                url: "/swagger.json",
                dom_id: '#swagger-ui',
                deepLinking: true,
                presets: [
                    SwaggerUIBundle.presets.apis,
                    SwaggerUIStandalonePreset
                ],
                plugins: [
                    SwaggerUIBundle.plugins.DownloadUrl
                ],
                layout: "StandaloneLayout",
                docExpansion: "list",
                defaultModelsExpandDepth: 1,
                defaultModelExpandDepth: 1,
                defaultModelRendering: "model",
                displayRequestDuration: true,
                filter: true,
                showExtensions: true,
                showCommonExtensions: true,
                syntaxHighlight: {
                    activated: true,
                    theme: "monokai"
                },
                tryItOutEnabled: true,
                requestInterceptor: (req) => {
                    req.headers['Accept'] = 'application/json';
                    return req;
                }
            });
            window.ui = ui;
        }
    </script>
</body>
</html> 