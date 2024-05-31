<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contoso Sample Web Chat</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        body {
            margin: 0;
        }
        h1 {
            color: whitesmoke;
            font-family: Segoe UI;
            font-size: 16px;
            line-height: 20px;
            margin: 0;
            padding: 0 20px;
        }
        #banner {
            align-items: center;
            background-color: black;
            display: flex;
            height: 50px;
        }
        #webchat {
            height: calc(100% - 50px);
            overflow: hidden;
            position: fixed;
            top: 50px;
            width: 100%;
        }
    </style>
</head>
<body>
    <div>
        <div id="banner">
            <h1>RideAway Agent</h1>
        </div>
        <div id="webchat" role="main"></div>
    </div>

    <script crossorigin="anonymous" src="https://cdn.botframework.com/botframework-webchat/latest/webchat.js"></script>

    <script>
        (async function () {
            const styleOptions = {
                hideUploadButton: true
            };

            const tokenEndpointURL = new URL('https://defaultc371d4f5b34f4b069e66517fed9042.20.environment.api.powerplatform.com/powervirtualagents/botsbyschema/cr4c5_esgiProjetAnnuel1/directline/token?api-version=2022-03-01-preview');

            const locale = document.documentElement.lang || 'fr-FR'; 

            const apiVersion = tokenEndpointURL.searchParams.get('api-version');

            const [directLineURL, token] = await Promise.all([
                fetch(new URL(`/powervirtualagents/regionalchannelsettings?api-version=${apiVersion}`, tokenEndpointURL))
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Failed to retrieve regional channel settings.');
                        }

                        return response.json();
                    })
                    .then(({ channelUrlsById: { directline } }) => directline),
                fetch(tokenEndpointURL)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Failed to retrieve Direct Line token.');
                        }

                        return response.json();
                    })
                    .then(({ token }) => token)
            ]);

            const directLine = WebChat.createDirectLine({ domain: new URL('v3/directline', directLineURL), token });

            const subscription = directLine.connectionStatus$.subscribe({
                next(value) {
                    if (value === 2) {
                        directLine.postActivity({
                            localTimezone: Intl.DateTimeFormat().resolvedOptions().timeZone,
                            locale,
                            name: 'startConversation',
                            type: 'event'
                        }).subscribe();

                        // Only send the event once, unsubscribe after the event is sent.
                        subscription.unsubscribe();
                    }
                }
            });

            WebChat.renderWebChat({ directLine, locale, styleOptions }, document.getElementById('webchat'));
        })();
    </script>
</body>
</html>