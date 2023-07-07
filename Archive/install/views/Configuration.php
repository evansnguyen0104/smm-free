<?php
    /**
     * Return an array of timezones
     *
     * @return array
     */
    function tz_list()
    {
        $timezoneIdentifiers = DateTimeZone::listIdentifiers();
        $utcTime = new DateTime('now', new DateTimeZone('UTC'));

        $tempTimezones = array();
        foreach ($timezoneIdentifiers as $timezoneIdentifier) {
            $currentTimezone = new DateTimeZone($timezoneIdentifier);

            $tempTimezones[] = array(
                'offset' => (int)$currentTimezone->getOffset($utcTime),
                'identifier' => $timezoneIdentifier
            );
        }

        // Sort the array by offset, identifier ascending
        usort($tempTimezones, function($a, $b) {
            return ($a['offset'] == $b['offset'])
                ? strcmp($a['identifier'], $b['identifier'])
                : $a['offset'] - $b['offset'];
        });

        $timezoneList = array();
        foreach ($tempTimezones as $key => $tz) {
            $sign                                = ($tz['offset'] > 0) ? '+' : '-';
            $offset                              = gmdate('H:i', abs($tz['offset']));
            $timezoneList[$key]['diff_from_GMT'] = '(UTC ' . $sign . $offset . ') ';
            $timezoneList[$key]['zone']          = 	$tz['identifier'];
        }
        return $timezoneList;
    }

?>
<form name="config-form" id="config-form" action="install.php" method="post">
    <div class="section clearfix">
        <p>1. Please enter your database connection details.</p>
        <hr />
        <div>
            <div class="form-group clearfix">
                <label for="host" class=" col-md-3">Database Host <span class="text-danger">(*)</span></label>
                <div class="col-md-9">
                    <input type="text" value="" id="host"  name="host" class="form-control" placeholder="Database Host (usually localhost)" />
                </div>
            </div>
            <div class="form-group clearfix">
                <label for="dbuser" class=" col-md-3">Database User <span class="text-danger">(*)</span></label>
                <div class=" col-md-9">
                    <input type="text" value="" name="dbuser" class="form-control" autocomplete="off" placeholder="Database user name" />
                </div>
            </div>
            <div class="form-group clearfix">
                <label for="dbpassword" class=" col-md-3">Password <span class="text-danger">(*)</span></label>
                <div class=" col-md-9">
                    <input type="password" value="" name="dbpassword" class="form-control" autocomplete="off" placeholder="Database user password" />
                </div>
            </div>
            <div class="form-group clearfix">
                <label for="dbname" class=" col-md-3">Database Name <span class="text-danger">(*)</span></label>
                <div class=" col-md-9">
                    <input type="text" value="" name="dbname" class="form-control" placeholder="Database Name" />
                </div>
            </div>
        </div>
    </div>
    <div class="section clearfix">
        <p>2. Please enter your account details for administration.</p>
        <hr />
        <div>
            <div class="form-group clearfix">
                <label for="fullname" class=" col-md-3">First Name <span class="text-danger">(*)</span></label>
                <div class="col-md-9">
                    <input type="text" value=""  id="first_name"  name="first_name" class="form-control"  placeholder="First Name" />
                </div>
            </div>

            <div class="form-group clearfix">
                <label for="fullname" class=" col-md-3">Last Name <span class="text-danger">(*)</span></label>
                <div class="col-md-9">
                    <input type="text" value=""  id="last_name"  name="last_name" class="form-control"  placeholder="Last Name" />
                </div>
            </div>

            <div class="form-group clearfix">
                <label for="email" class=" col-md-3">Email <span class="text-danger">(*)</span></label>
                <div class=" col-md-9">
                    <input type="text" value="" name="email" class="form-control" placeholder="Your email" />
                </div>
            </div>
            <div class="form-group clearfix">
                <label for="password" class=" col-md-3">Password <span class="text-danger">(*)</span></label>
                <div class=" col-md-9">
                    <input type="password" value="" name="password" class="form-control" placeholder="Login password" />
                </div>
            </div>
            <div class="form-group clearfix">
                <label class=" col-md-3">Timezone server <span class="text-danger">(*)</span></label>
                <div class=" col-md-9">
                    <select name="timezone" class="form-control">
                    <?php foreach(tz_list() as $t) { ?>
                        <option value="<?php echo $t['zone'] ?>" >
                            <?php echo $t['diff_from_GMT'] . ' - ' . $t['zone'] ?>
                        </option>
                    <?php } ?>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="section clearfix">
        <p>3. Mfb Api Token.</p>
        <hr />
        <div>
            <div class="form-group clearfix">
                <label for="purchase_code" class=" col-md-3">Mfb api token <span class="text-danger">(*)</span></label>
                <div class="col-md-9">
                    <input type="text" value="45ca0421-2b70-49ec-ba94-b76bd4d1e25b" readonly id="purchase_code"  name="purchase_code" class="form-control"  placeholder="Find in codecanyon item download section" />
                </div>
            </div>
        </div>
    </div>

    <div class="panel-footer">
        <div id="alert-container">
        </div>
        <button type="submit" class="btn btn-info form-next">
            <span class="loader hide"> Processing...</span>
            <span class="button-text"><i class='fa fa-chevron-right'></i> Finish</span>
        </button>
    </div>
</form>
