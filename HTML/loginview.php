<div class="container" style="margin-top:30px">
    <div class="row">
        <div class="col-sm-4">
            <h2>LOGIN</h2>
            <form method = "post" action = "./DOMAINLOGIC/login.dom.php">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email" id="email" required><br>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" name="pw" id="pwd" required><br>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <button class="btn btn-success" type="submit">Login</button>
            </form>
        </div>
    </div>
</div>
