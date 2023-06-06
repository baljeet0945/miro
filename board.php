<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Boards picker demo</title>
    <style>
        html {
            font-family: Arial;
            font-size: 14px;
            background: #f6f6f6;
            padding: 10px;
        }
        select {
            font-family: Arial;
            display: inline-block;
            vertical-align: baseline;
            font-size: 14px;
            height: 32px;
            background-color: white;
            border: 1px solid #999;
            border-radius: 4px;
        }
        button {
            font-family: Arial;
            display: inline-block;
            vertical-align: baseline;
            font-size: 14px;
            height: 32px;
            background-color: white;
            margin-left: 12px;
            border-radius: 4px;
            border: 1px solid #999;
        }
        select:hover, button:hover {
            border: 1px solid #333;
        }
        .results {
            margin-top: 20px;
            white-space: pre;
            display: none;
            width: 100%;
            height: 200px;
            border: none;
            background-color: rgba(0,0,0,0);
            font-family: Arial;
            font-size: 12px;
            resize: none;
        }
    </style>   
    <script type="text/javascript" src="https://miro.com/app/static/boardsPicker.1.0.js"></script>
</head>
<body>
<label>
    Choose picker action
    <select>
        <option value="select">select</option>
        <option value="access-link">access-link</option>
    </select>
</label>
<button>
    Open Boards Picker
</button>

<div class="container">
</div>    

<script>
    var button = document.querySelector('button')
    var actionSelect = document.querySelector('select')
    var resultsBox = document.querySelector('.results')
    button.addEventListener('click', () => {
        miroBoardsPicker.open({
            clientId: '3458764540421697065', // Replace it with your app ClientId
            allowCreateAnonymousBoards: true,
            action: actionSelect.value,
            getAnonymousUserToken: () => getTokenFromServer(), // Provide token in async way
            success: (data) => {
                console.log(data);
                 // document.querySelector(".container").innerHTML = `
                 //  <iframe
                 //    class="iframe"
                 //    width="768"
                 //    height="432"
                 //    src="https://miro.com/app/live-embed/${data?.id}/"
                 //    frameborder="0"
                 //    scrolling="no"
                 //    allowfullscreen
                 //  ></iframe>`;
            }
        })
    })

</script>
</body>
</html>