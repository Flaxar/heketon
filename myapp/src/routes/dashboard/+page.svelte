<style>
    @import "/custom.scss";

    .primary {
        background-color: #62b6cb;
    }

    .secondary {
        background-color: #bee9e8;
    }

    .btn-primary {
        background-color: grey;
        color: black;
        
    }
    
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    
    var temp;

    const socket = new WebSocket('ws://sem-prijde-adresa');
    socket.addEventListener('message', function (event) {
        temp = JSON.parse(event.data).temp;
    });

    function getName() {
        // TODO: from api
        return "Blakub Jaha"
    }
 

    let targetTemp = 21.0;
    function plusTargetTemp() {
        targetTemp += 0.5;
        return 0;
    }

    function minusTargetTemp() {
        targetTemp -= 0.5;
        return 0;
    }

    let brightness = 100;
    function plusBrightness() {
        brightness += brightness + 10 > 100 ? 0 : 10;
        return 0;
    }

    function minusBrightness() {
        brightness -= brightness - 10 < 0 ? 0 : 10;
        return 0;
    }

    function getWindowOpenDuration() {
        return "6 min."
    }

    function getPeopleCount() {
        return "3";
    }


</script>

<nav class="navbar navbar-expand-lg bg-body-tertiary primary" >
    <img src="/icon.png" style="height: 50px">
    <div class="container-fluid">
        <a class="navbar-brand" style="color: black;"  aria-current="page">DOMOVSKÁ STRÁNKA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active " style="color: black;" href="#">Místnosti</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: black;" href="#">Topení</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: black;" href="#">Osvětlení</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="row m-3">
    <div class="card m-3" style="width: 18rem; height:fit-content">
        <img src="https://t3.ftcdn.net/jpg/04/67/21/78/360_F_467217883_i7jomoE1G0GmW2CPB2aDmJVWIyN32hCR.jpg" class="card-img-top">
        <div class="card-body">
            <p style="font-size: 24px; font-weight: bold;">Aktuální informace</p>
            <p class="card-text">Teplota: {temp}</p>
            <p class="card-text">Cílová teplota: {targetTemp}˚C</p>
            <div class="pb-4">
                <button class="btn btn-secondary" style="background-color:cornflowerblue" on:click={minusTargetTemp}>
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
                    </svg>
                </button>
                <button class="btn btn-secondary" style="background-color:coral" on:click={plusTargetTemp}>
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                    </svg>
                </button>
            </div>
            <p class="card-text">Doba větrání: {getWindowOpenDuration()}</p>
            <p class="card-text">Intenzita světla: {brightness}%</p>
            <div class="pb-4">
                <button class="btn btn-secondary" style="background-color:gray" on:click={minusBrightness}>
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-brightness-alt-high" viewBox="0 0 16 16">
                        <path d="M8 3a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 3zm8 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zm-13.5.5a.5.5 0 0 0 0-1h-2a.5.5 0 0 0 0 1h2zm11.157-6.157a.5.5 0 0 1 0 .707l-1.414 1.414a.5.5 0 1 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm-9.9 2.121a.5.5 0 0 0 .707-.707L3.05 5.343a.5.5 0 1 0-.707.707l1.414 1.414zM8 7a4 4 0 0 0-4 4 .5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5 4 4 0 0 0-4-4zm0 1a3 3 0 0 1 2.959 2.5H5.04A3 3 0 0 1 8 8z"/>
                    </svg>
                </button>
                <button class="btn btn-secondary" style="background-color:orange" on:click={plusBrightness}>
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-brightness-high-fill" viewBox="0 0 16 16">
                        <path d="M12 8a4 4 0 1 1-8 0 4 4 0 0 1 8 0zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
                      </svg>
                </button>
            </div>
            <p class="card-text">Osob v kanceláři: {getPeopleCount()}</p>
        </div>
    </div>
    <div class="card m-3" style="width:60%;">
        <img src="/temp_graph.png" class="card-img-top" style="">
    </div>
    <div class="card m-3 justify-content-center align-items-center" style="width:20%;">
        <p class="mb-4" style="font-size: 24px; font-weight: bold;">Doba větrání</p>
        <img src="/window_graph.png" class="card-img-top" style="">
    </div>
    
    <!-- <div class="col">
        
    </div> -->
    
</div>
