<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 /**
 * Create Form Template base on Elements
 * @param array $elements
 */
function render_elements_form($elements)
{
    $xhtml = null;
    if (!empty($elements)) {
        foreach ($elements as $element) {
            $xhtml .= render_element_form($element);
        }
    }
    return $xhtml;
}

function render_element_form($element, $param = null)
{
    $xhtml = null;

    $type = (isset($element['type'])) ? $element['type'] : 'input';
    switch ($type) {
        
        case 'input':
            $xhtml = sprintf(
                '<div class="%s">
                    <div class="form-group">
                        %s
                        %s
                    </div>
                </div> ',
                $element['class_main'],
                $element['label'],
                $element['element']
            );
            break;

        case 'password':
            $xhtml = sprintf(
                '<div class="%s">
                    <div class="form-group">
                        %s
                        %s
                    </div>
                </div> ',
                $element['class_main'],
                $element['label'],
                $element['element']
            );
            break;

        case 'switch':
            $xhtml = sprintf(
                '<div class="%s">
                    <label class="custom-switch">      
                        %s
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description">%s</span> 
                    </label>
                </div> ', $element['class_main'], $element['element'], $element['label']
            );
            break;

        case 'checkbox':
            $xhtml = sprintf(
                '<div class="%s">
                    <div class="form-group">
                        <div class="custom-controls-stacked">
                            <label class="form-check">
                                %s
                                <span class="custom-control-label">&nbsp;%s</span>
                            </label>
                        </div>
                    </div>
                </div> ', $element['class_main'], $element['element'], $element['label']
            );
            break;

        case 'exchange_option':
            $item1_title = $element['item1']['name'];
            $item2_title = $element['item2']['name'];
            $xhtml = sprintf(
                '<div class="%s">
                    <div class="form-group">
                        %s
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <span class="input-group-text">1 %s =</span>
                            </span>
                            %s
                            <span class="input-group-append">
                                <span class="input-group-text new-currency-code"> %s </span>
                            </span>
                        </div>
                    </div>
                </div>', $element['class_main'], $element['label'], $item1_title, $element['element'], $item2_title
            );
            break;

        case 'admin-change-provider-service-list':
            $xhtml = sprintf(
                '<div class="%s">
                    <div class="dimmer">
                    <div class="loader"></div>
                    <div class="dimmer-content">
                        %s
                        %s
                    </div>
                    </div>
                </div>', $element['class_main'], $element['label'], $element['element']
            );
            break;

        case 'button':
            $xhtml = sprintf(
                '<div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        %s
                    </div>
                </div>',
                $element['element']
            );
    }

    return $xhtml;
}
/**
 * @param array $params
 * @return create html for modal
 */
function render_modal_html($params = [])
{
    $xhtml = null;
    $params = [
        'btn-class'        => (isset($params['btn-class'])) ? $params['btn-class'] : 'btn-outline-primary',
        'btn-title'        => (isset($params['btn-title'])) ? $params['btn-title'] : 'Detail',
        'modal-id'         => (isset($params['modal-id'])) ? $params['modal-id'] : 'modal-1',
        'modal-size'       => (isset($params['modal-size'])) ? $params['modal-size'] : 'modal-lg',
        'modal-title'            => (isset($params['modal-title'])) ? $params['modal-title'] : 'Modal Details',
        'modal-body-content'     => (isset($params['modal-body-content'])) ? $params['modal-body-content'] : 'Modal content',
    ];
    $params['data-target'] = '#' . $params['modal-id'];

    $xhtml    = sprintf(
        '<button class="btn %s btn-sm" type="button" class="dash-btn" data-toggle="modal" data-target="%s">%s</button>
        <div id="%s" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog %s" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">%s</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="text-align:left">
                        %s
                    </div>
                </div>
            </div>
        </div>',
        $params['btn-class'], $params['data-target'], $params['btn-title'], $params['modal-id'], $params['modal-size'], $params['modal-title'], $params['modal-body-content']);
    return $xhtml;
}

/**
 * From V4.0
 * @param $item data
 * @return html button details
 */
if (!function_exists('render_modal_body_content')) {
    function render_modal_body_content($controller_name, $item = [])
    {
        switch ($controller_name) {
            case 'refill':
                $api_name = $item['api_name'];
                $details = json_encode(json_decode($item['details']), JSON_PRETTY_PRINT);
                $date = convert_timezone($item['last_updated'], "user");
                $xhtml    = sprintf(
                    '<div class="row justify-content-md-center">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>%s</label>
                                <textarea rows="7" readonly  class="form-control square">%s</textarea>
                            </div>
                        </div> 
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label >Last Update</label>
                                <input type="text" class="form-control square" readonly value="%s">
                            </div>
                        </div>
                    </div>',
                    $api_name, $details, $date);
                break;

            case 'services':

                if (!empty($item['desc'])) {
                    $description = html_entity_decode($item['desc'], ENT_QUOTES);
                    $description = str_replace("\n", "<br>", $description);
                    $xhtml    = sprintf(
                        '<div class="form-group">
                            %s
                        </div>',
                        $description);
                }
                break;

        }
        return $xhtml;
    }
}