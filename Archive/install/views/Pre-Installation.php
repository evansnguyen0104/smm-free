<div class="section">
    <p>1. Please configure your PHP settings to match following requirements:</p>
    <hr />
    <div>
        <table>
            <thead>
                <tr>
                    <th width="25%">PHP Settings</th>
                    <th width="27%">Current Version</th>
                    <th>Required Version</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>PHP Version</td>
                    <td><?php echo $current_php_version; ?></td>
                    <td><?php echo $php_version_required; ?>+</td>
                    <td class="text-center">
                        <?php if ($php_version_success) { ?>
                            <i class="status fa fa-check-circle-o"></i>
                        <?php } else { ?>
                            <i class="status fa fa-times-circle-o"></i>
                        <?php } ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="section">
    <p>2. Please make sure the extensions/settings listed below are installed/enabled:</p>
    <hr />
    <div>
        <table>
            <thead>
                <tr>
                    <th width="25%">Extension</th>
                    <th width="27%">Current Settings</th>
                    <th>Required Settings</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>MySQLi</td>
                    <td> <?php if ($mysql_success) { ?>
                            On
                        <?php } else { ?>
                            Off
                        <?php } ?>
                    </td>
                    <td>On</td>
                    <td class="text-center">
                        <?php if ($mysql_success) { ?>
                            <i class="status fa fa-check-circle-o"></i>
                        <?php } else { ?>
                            <i class="status fa fa-times-circle-o"></i>
                        <?php } ?>
                    </td>
                </tr>

                <tr>
                    <td>GD</td>
                    <td> <?php if ($gd_success) { ?>
                            On
                        <?php } else { ?>
                            Off
                        <?php } ?>
                    </td>
                    <td>On</td>
                    <td class="text-center">
                        <?php if ($gd_success) { ?>
                            <i class="status fa fa-check-circle-o"></i>
                        <?php } else { ?>
                            <i class="status fa fa-times-circle-o"></i>
                        <?php } ?>
                    </td>
                </tr>

                <tr>
                    <td>PHP Zip</td>
                    <td> <?php if ($zip_success) { ?>
                            On
                        <?php } else { ?>
                            Off
                        <?php } ?>
                    </td>
                    <td>On</td>
                    <td class="text-center">
                        <?php if ($zip_success) { ?>
                            <i class="status fa fa-check-circle-o"></i>
                        <?php } else { ?>
                            <i class="status fa fa-times-circle-o"></i>
                        <?php } ?>
                    </td>
                </tr>

                <tr>
                    <td>cURL</td>
                    <td> <?php if ($curl_success) { ?>
                            On
                        <?php } else { ?>
                            Off
                        <?php } ?>
                    </td>
                    <td>On</td>
                    <td class="text-center">
                        <?php if ($curl_success) { ?>
                            <i class="status fa fa-check-circle-o"></i>
                        <?php } else { ?>
                            <i class="status fa fa-times-circle-o"></i>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td>allow_url_fopen</td>
                    <td> <?php if ($allow_url_fopen_success) { ?>
                            On
                        <?php } else { ?>
                            Off
                        <?php } ?>
                    </td>
                    <td>On</td>
                    <td class="text-center">
                        <?php if ($allow_url_fopen_success) { ?>
                            <i class="status fa fa-check-circle-o"></i>
                        <?php } else { ?>
                            <i class="status fa fa-times-circle-o"></i>
                        <?php } ?>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>

<div class="section">
    <p>3. Please make sure you have set the <strong>writable</strong> permission on the following folders/files:</p>
    <hr />
    <div>
        <table>
            <tbody>
                <?php
                foreach ($writeable_directories as $value) {
                    ?>
                    <tr>
                        <td width="87%"><?php echo $value; ?></td>  
                        <td class="text-center">
                            <?php if (is_writeable(".." . $value)) { ?>
                                <i class="status fa fa-check-circle-o"></i>
                                <?php
                            } else {
                                $all_requirement_success = false;
                                ?>
                                <i class="status fa fa-times-circle-o"></i>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<div class="panel-footer">
    <button <?php
    if (!$all_requirement_success) {
        echo "disabled=disabled";
    }
    ?> class="btn btn-info form-next"><i class='fa fa-chevron-right'></i> Next</button>
</div>