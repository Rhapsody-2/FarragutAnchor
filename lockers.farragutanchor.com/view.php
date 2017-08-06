            <h2 style="color: #1B2845; text-align: center">Your locker number is</h1>
            <fieldset style="width: 25%; margin: auto">
                <div class="row" style="margin-bottom: 0">
                    <h1 style="color: #1B2845; text-align: center" class="tooltipped" data-position="top" data-tooltip="<?php echo $_SESSION['locker.wing'] . ", " . $_SESSION['locker.area']; ?>"><?php echo $_SESSION['locker.number'] ?></h2>
                </div>
            </fieldset>
