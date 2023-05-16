<style>
    @import "/custom.scss";

    .primary {
        background-color: #bee9e8;
    }

    .secondary {
        background-color: #62b6cb;
    }

    .btn-primary {
        background-color: grey;
        color: black;
    }
</style>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    function login() {
        location.replace("/dashboard");
    }
</script>

<div class="brno-background" style="background-image: url('/brno-background2.jpg');">
    <div class="d-flex flex-column min-vh-100 justify-content-center align-items-center" style="opacity: 100%;">
        <div class="card">
            <div class="container justify-content-center pt-3 primary">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <h2 class="justify-content-center">Přihlášení</h2>
                </div>
                
            </div>
            <div class="card-body secondary">
                <form>
                    <div class="mb-3">
                        <label for="usernameInput" class="form-label">Uživatelské jméno</label>
                        <input type="email" class="form-control" id="usernameInput" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="passwordInput" class="form-label">Heslo</label>
                        <input type="password" class="form-control" id="passwordInput">
                    </div>
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <button type="submit" class="btn btn-primary" on:click={login}>Přihlásit se</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

