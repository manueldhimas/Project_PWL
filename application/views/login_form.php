<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('admin/_partials/head.php'); ?>
    <style>
        /* Add your CSS styles here */

        body {
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
        }

        h1 {
            font-family: sans-serif;
            color: #008cba;
            text-align: center;
        }

        p {
            font-family: sans-serif;
            color: grey;
            text-align: center;
        }

        form {
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            padding: 2rem 0;
            max-width: 600px;
            margin: auto;
        }

        label {
            display: inline-block;
            margin-bottom: 0.5rem;
        }

        input {
            display: inline-block;
            padding: 0.5rem;
            width: 100%;
        }

        input:focus {
            outline-color: dodgerblue;
        }

        .invalid {
            border: 2px solid rgb(153, 16, 16);
        }

        .invalid::placeholder {
            color: rgb(153, 16, 16);
        }

        .invalid-feedback:empty {
            display: none;
        }

        .invalid-feedback {
            font-size: smaller;
            color: rgb(153, 16, 16);
        }

        .button {
            background-color: #008cba;
            border: 2px solid transparent;
            border-radius: 8px;
            color: white;
            padding: 8px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 1rem;
            font-family: sans-serif;
        }

        .button:hover {
            opacity: 0.8;
        }

        .button:active {
            border: 2px solid rgba(0, 0, 0, 0.5);
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Login</h1>
        <p>Masuk ke Dashboard</p>

        <?php if ($this->session->flashdata('message_login_error')): ?>
            <div class="invalid-feedback">
                <?= $this->session->flashdata('message_login_error') ?>
            </div>
        <?php endif ?>

        <form action="" method="post">
            <div>
                <label for="name">Email/Username*</label>
                <input type="text" name="username" class="<?= form_error('username') ? 'invalid' : '' ?>"
                    placeholder="Your username or email" value="<?= set_value('username') ?>" required />
                <div class="invalid-feedback">
                    <?= form_error('username') ?>
                </div>
            </div>
            <div>
                <label for="password">Password*</label>
                <input type="password" name="password" class="<?= form_error('password') ? 'invalid' : '' ?>"
                    placeholder="Enter your password" value="<?= set_value('password') ?>" required />
                <div class="invalid-feedback">
                    <?= form_error('password') ?>
                </div>
            </div>

            <div>
                <input type="submit" class="button" value="Login">
            </div>
        </form>
    </div>
    <?php $this->load->view('admin/_partials/footer.php'); ?>
</body>

</html>