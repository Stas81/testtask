function DetectUerData(){
    console.log('detectin user data');
                var plugins = {
                    flash           :PluginDetect.getVersion("flash"),
                    java            :PluginDetect.getVersion("java"),
                    iecomponent     :PluginDetect.getVersion("iecomponent"),
                    vlc             :PluginDetect.getVersion("vlc"),
                    silverlight     :PluginDetect.getVersion("silverlight"),
                    activex         :PluginDetect.getVersion("activex"),
                    adobereader     :PluginDetect.getVersion("adobereader"),
                    devalvr         :PluginDetect.getVersion("devalvr"),
                    pdfjs           :PluginDetect.getVersion("pdfjs"),
                    pdfreader       :PluginDetect.getVersion("pdfreader"),
                    quicktime       :PluginDetect.getVersion("quicktime"),
                    realplayer      :PluginDetect.getVersion("realplayer"),
                    shockwave       :PluginDetect.getVersion("shockwave"),
                    windowsmediaplayer:PluginDetect.getVersion("windowsmediaplayer"),
                };
                var detective = new Detector();                
                var fonts = {
                    //'monospace':detective.detect('monospace'),
                    'sans-serif':detective.detect('sans-serif'),
                    //'fantasy':detective.detect('fantasy'),
                    'Arial':detective.detect('Arial'),
                    'Arial Black':detective.detect('Arial Black'),
                    'Century Gothic':detective.detect('Century Gothic'),
                    'Courier New':detective.detect('Courier New'),
                    //'Tahoma':detective.detect('Tahoma'),
                    'Times New Roman':detective.detect('Times New Roman'),
                    //'Times':detective.detect('Times'),
                    //'Verdana':detective.detect('Verdana'),
                    //'Verona':detective.detect('Verona'),
                };
                
                var userData = {
                    userAgent:navigator.userAgent, 
                    screenWidth:window.screen.width,
                    screenHeight:window.screen.height,
                    plugins:JSON.stringify(plugins),
                    fonts:JSON.stringify(fonts),
                };                

                json=JSON.stringify(userData);
                $.ajax({
                        url : "new-template/post-visitor-data.php",
                        type: "POST",
                        data : {
                            'userData' : json
                            },
                    success: function()
                    {
                        console.log('POST succes')
                    },
                    error: function ()
                    {
                        console.log('POST failed')
                    }
                });
                }