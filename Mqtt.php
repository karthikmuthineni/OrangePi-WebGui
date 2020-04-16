<!DOCTYPE html>
<html class="no-js" lang="en">

<head>

    <link rel="stylesheet" href="normalize.css">
    <link rel="stylesheet" href="stylee.css">
    <link rel="stylesheet" href="foundation.css">
    <link rel="stylesheet" href="jquery.minicolors.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css">


<title>MQTT Page</title>
<link rel="stylesheet" type="text/css" href="navigation.css">
</head>

<div class="navbar">
  <a href="navigation.html">Home</a>
  <a href="Wlan.html">Wlan</a>
  <a href="Modbus.html">Modbus RTU</a>
  <a href="Modbustcp.html">Modbus TCP</a>
  <a href="Mqtt.html">MQTT</a>
  <a href="http://192.168.1.101:1880/ui/#!/0?socketid=jXgKx74Sqk5BUxoeAAAA">I/O Status</a>
  <a href="Logout.html">Logout</a>
</div>

<div class="main">
  <p>..</p>
</div>

<link href="site.css" rel="stylesheet">
<h1>Welcome to MQTT Setup Page</h1>

<body class="notconnected">


<div id="content" class="row">
<div id="connection" class="row large-12 columns">

    <div class="large-8 columns conniTop">
        <h3>Connection</h3>
    </div>

    <div class="large-1 columns conniStatus">
        <div id="connectionStatus"></div>
    </div>

    <div class="large-2 columns conniArrow">
        <a class="small bottom conniArrow" onclick="websocketclient.render.toggle('conni');">
            <div class="icon-arrow-chevron"></div>
        </a>
    </div>
    <div class="large-12 columns" id="conniMain">
        <div class="panel">
            <div class="row">
                <form class="custom">
                    <div class="large-5 columns">
                        <label>Host *</label>
                        <input id="urlInput" type="text" value="mqtt.netpie.io">
                    </div>

                    <div class="large-1 columns">
                        <label>Port *</label>
                        <input id="portInput" type="text" value="1883"/>
                    </div>

                    <div class="large-4 columns">
                        <label>ClientID *</label>
                        <input id="clientIdInput" type="text"/>
                    </div>

                    <div class="large-2 columns">
                        <a id="connectButton" class="small button" onclick="websocketclient.connect();">Connect</a>
                    </div>

                    <div class="large-2 columns">
                        <a id="disconnectButton" class="small button"
                           onclick="websocketclient.disconnect();">Disconnect</a>
                    </div>

                    <div class="large-4 columns">
                        <label>Username</label>
                        <input id="userInput" type="text"/>
                    </div>

                    <div class="large-3 columns">
                        <label>Password</label>
                        <input id="pwInput" type="password"/>
                    </div>

                    <div class="large-4 columns">
                        <label>Last-Will Topic</label>
                        <input id="lwTopicInput" type="text"/>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<div class="empty"></div>
<div id="publish-sub" class="row large-12 columns">
    <div class="columns large-8">
        <div class="large-9 columns publishTop">
            <h3>Publish</h3>
        </div>

        <div class="large-3 columns publishArrow">
            <a class="small bottom publishArrow" onclick="websocketclient.render.toggle('publish');">
                <div class="icon-arrow-chevron"></div>
            </a>
        </div>

        <div class="large-12 columns" id="publishMain">

            <!-- Grid Example -->
            <div class="row panel" id="publishPanel">
                <div class="large-12 columns">
                    <form class="custom">
                        <div class="row">
                            <div class="large-6 columns">
                                <label>Topic</label>
                                <input id="publishTopic" type="text" value="@shadow/data/update">
                            </div>
                            <div class="large-2 columns">
                                <label for="publishQoSInput">QoS</label>
                                <select id="publishQoSInput" class="small">
                                    <option>0</option>
                                    <option>1</option>
                                    <option>2</option>
                                </select>
                            </div>
                            <div class="large-2 columns">
                                <label>Retain</label>
                                <input id="publishRetain" type="checkbox">
                            </div>
                            <div class="large-2 columns">
                                <a class="small button" id="publishButton"
                                   onclick="websocketclient.publish($('#publishTopic').val(),$('#publishPayload').val(),parseInt($('#publishQoSInput').val(),10),$('#publishRetain').is(':checked'))">Publish</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="large-12 columns">
                                <label>Message</label>
                                <input id="publishPayload" type="text" value='{"data": {"sense":191}}'>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="empty"></div>
        <div class="large-9 columns messagesTop">
            <h3>Messages</h3>
        </div>

        <div class="large-3 columns messagesArrow">
            <a class="small bottom messagesArrow" onclick="websocketclient.render.toggle('messages');">
                <div class="icon-arrow-chevron"></div>
            </a>
        </div>

        <div class="large-12 columns" id="messagesMain">

            <!-- Grid Example -->
            <div class="row panel">
                <div class="large-12 columns">
                    <form class="custom">
                        <!--<div class="row">-->
                        <!--<div class="large-10 columns">-->
                        <!--<label>Filter</label>-->
                        <!--<input id="filterString" type="text">-->
                        <!--</div>-->

                        <!--<div class="large-2 columns">-->
                        <!--<a class="small button" id="filterButton"-->
                        <!--onclick="websocketclient.filter($('#filterString').val())">Filter</a>-->
                        <!--</div>-->
                        <!--</div>-->

                    </form>
                    <div class="row">
                        <ul id="messEdit" class="disc">

                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="columns large-4">

        <div class="large-8 columns subTop">
            <h3>Subscriptions</h3>
        </div>

        <div class="large-3 columns subArrow">
            <a class="small bottom subArrow" onclick="websocketclient.render.toggle('sub');">
                <div class="icon-arrow-chevron"></div>
            </a>
        </div>
        <div class="large-12 columns" id="subMain">
            <div class="row panel">
                <div class="large-12 columns">

                    <a id="addSubButton" href="#data" class="small button addSubButton">Add New Topic Subscription</a>

                    <div style="display:none">
                        <div id="data">
                            <form class="custom">
                                <div class="row large-12 columns">
                                    <div class="large-4 columns">
                                        <label>Color</label>
                                        <input class="color" id="colorChooser" type="hidden">
                                    </div>
                                    <div class="large-5 columns">
                                        <label for="QoSInput">QoS</label>
                                        <select id="QoSInput" class="small">
                                            <option>2</option>
                                            <option>1</option>
                                            <option>0</option>
                                        </select>
                                    </div>
                                    <div class="large-3 columns">
                                        <a class="small button" id="subscribeButton"
                                           onclick="if(websocketclient.subscribe($('#subscribeTopic').val(),parseInt($('#QoSInput').val()),$('#colorChooser').val().substring(1))){$.fancybox.close();}">Subscribe</a>
                                    </div>
                                </div>
                                <div class="row large-12 columns">
                                    <div class="large-12 columns">
                                        <label>Topic</label>
                                        <input id="subscribeTopic" type="text" value="testtopic/#">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <ul id="innerEdit" class="disc">

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/1.3.1/lodash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/4.2.3/js/foundation.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/4.2.3/js/foundation/foundation.forms.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.1.0/moment.min.js"></script>
<script src="jquery.minicolors.min.js"></script>
<script src="mqttws31.js"></script>
<script src="encoder.js"></script>
<script src="app.js"></script>
<script src="config.js"></script>

<script>

    function randomString(length) {
        var text = "";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        for (var i = 0; i < length; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length));
        return text;
    }

    $(document).foundation();
    $(document).ready(function () {

        $('#urlInput').val(websocketserver);
        $('#portInput').val(websocketport);
        $('#clientIdInput').val();

        $('#colorChooser').minicolors();

        $("#addSubButton").fancybox({
            'afterShow': function () {
                var rndColor = websocketclient.getRandomColor();
                $("#colorChooser").minicolors('value', rndColor);
            }
        });

        websocketclient.render.toggle('publish');
        websocketclient.render.toggle('messages');
        websocketclient.render.toggle('sub');
    });
</script>
</body>
</html>
