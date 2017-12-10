<?php include ROOT . '/views/layouts/header.php'; ?>

    <div class="container">
        <div class="row">
            <div class="col-xs-4 item-photo">
                <img style="max-width:100%;" src="../..<?=$event['event_sm_img'];?>" alt="<?=$event['event_name'];?>">
            </div>
            <div class="col-xs-5" style="border:0px solid gray">
                <h3><?=$event['event_name'];?></h3>
            </div>
            <div class="col-xs-3">
                <h3>Расписание сеансов</h3>
                <div class="form-group">
                    <label for="date">
                        <select name="" id="date">
                            <?php
                            foreach ($date as $value):?>
                            <option data-id="<?= $value['date_id'];?>"  value="Select"><?php echo $value['date'];?></option>
    <?php                   endforeach;?>
                        </select>
                    </label>
                    <button type="button" class="btn btn-primary" onclick="">Выбрать дату</button>
                </div>
                <div id="time">
                    <?php
                    foreach ($event_time as $value):?>
                        <div class="btn btn-info" style="float: left; padding-left: 5px;"><?= date("H:i", strtotime($value['event_time']));?></div>

                    <?php                   endforeach;?>
                </div>


            </div>
        </div>
    </div>

    <script>

        $(document).ready(function () {
            $("#date").change(function () {
                var id = $("#date option:selected").attr("data-id");
                $.ajax({
                    url: '/eventAjax/8',
                    type: 'POST',
                    data: "date="+id,
                    success: function (data) {
                        data = jQuery.parseJSON(data);
                        $("#time").empty();
                        $.each(data, function (i, item) {
                            $("#time").append('<div class="btn btn-info">'+item.event_time+'</div>');
                        });

                    }
                });
            });

        });

    </script>





<?php include ROOT . '/views/layouts/footer.php'; ?>