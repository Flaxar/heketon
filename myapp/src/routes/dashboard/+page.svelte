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

    

    function getName() {
        // TODO: from api
        return "Blakub Jaha"
    }

    function getTemp() {
        return "24˚C";
    }

    function getWindowOpenDuration() {
        return "6 min."
    }

    function getLightIntensity() {
        return "50%";
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
            <p class="card-text">Teplota: {getTemp()}</p>
            <p class="card-text">Cílová teplota: 21˚C</p>
            <p class="card-text">Doba větrání: {getWindowOpenDuration()}</p>
            <p class="card-text">Intenzita světla: {getLightIntensity()}</p>
            <p class="card-text">Osob v kanceláři: {getPeopleCount()}</p>
        </div>
    </div>
    <div class="card m-3" style="width:40%;">
        <img src="/temp_graph.png" class="card-img-top" style="">
    </div>
    <div class="card m-3 justify-content-center align-items-center" style="width:20%;">
        <p class="mb-4" style="font-size: 24px; font-weight: bold;">Doba větrání</p>
        <img src="/window_graph.png" class="card-img-top" style="">
    </div>
    
    <!-- <div class="col">
        
    </div> -->
    
</div>
