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
</script>

<nav class="navbar fixed-top navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid primary">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" style="color:black;">{getName()}</a>
                </li>
            </ul>   -->
            <ul class="nav justify-content-center">
                <li class="nav-item">
                     <a class="nav-link active" style="color:black;">Domovská stránka</a>
                </li>
            </ul>        
        </div>

        
        
      
        <img src="/icon.png" style="width: 100px">
      
      
    </div>
</nav>