<h1>Login</h1>
<form action="?action=/login" method="post">
    <div style="display: flex; flex-direction: column;">
        <div>
            <span>
                <ul>
                    <?php
                        if (isset($validator)){
                            foreach ($validator->getErrors('username') as $error){
                                echo "<li>$error</li>";
                            }
                        }
                    ?>
                </ul>
            </span>
            <label for="username">Username:</label>
            <input id="username" name="username" type="text">
        </div>


        <div>
            <span>
                    <?php
                        if (isset($validator)){
                            foreach ($validator->getErrors('password') as $error){
                                echo "<li>$error</li>";
                            }
                        }
                    ?>
            </span>
            <label for="password">Password:</label>
            <input id="password" name="password" type="password">
            <button type="submit">Login</button>
        </div>
    </div>
</form>
