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
                        <button type="submit" class="btn btn-primary">Přihlásit se</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

