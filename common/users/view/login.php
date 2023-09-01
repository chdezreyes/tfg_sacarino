<div class="row align-items-center">
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="card card-outline card-orange">
                <div class="card-header text-center">
                    <a href="#" class="h1"><img src="../resources/img/logo_inicio.jpg" height="40" class="img-responsive brand-image" alt=""></a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg text-secondary"><b>Acceso a la Aplicacion</b></p>

                    <form method="post">
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Email" name="userEmail" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <i class="material-icons">email</i>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Contraseña" name="userPassword">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <i class="material-icons">lock</i>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-secondary">
                                    <input type="checkbox" id="remember">
                                    <label for="remember">
                                        Recordarme
                                    </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" class="btn btn-secondary btn-block">Entrar</button>
                            </div>
                            <!-- /.col -->
                        </div>

                        <?php
                            $login = new ControllerUsers();
                            $login -> ctrUserLogin();
                        ?>
                    </form>
                    <br>
                    <p class="mb-1 text-center">
                        <a href="#"><span class="text-orange"> He olvidado mi contraseña </span></a>
                    </p>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.login-box -->
