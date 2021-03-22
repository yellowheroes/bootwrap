<?php
/**
 * Created by Yellow Heroes
 * Project: bootwrap
 * File: Alert.php
 * User: Robert
 * Date: 8/22/2020
 * Time: 21:57
 */
declare(strict_types=1);

namespace yellowheroes\bootwrap\libs\components;

use yellowheroes\bootwrap\libs as libs;
/**
 * Class Form - a container object that can be injected with form components
 *
 * Builds a Bootstrap HTML form.
 *
 * User can inject form elements into class Form to construct a Bootstrap HTML form.
 * Typical form elements are built using e.g. class: FormText, FormPassword, FormEmail, FormSelect, FormRadio.
 *
 * Class Form, in turn, can be injected into a BootWrap object as a component for it to be rendered in a Bootstrap template page.
 *
 *
 * @package yellowheroes\bootwrap\libs
 */
class Form implements libs\ComponentInterface
{
    public string $html = ''; // the built form-component HTML - to be injected into a BootWrap object
    private array $formElements = []; // container for injected form elements

    /**
     * @return string   : the form-component HTML - to be injected into a BootWrap object
     */
    public function build(?string $action = ''): string
    {
        $formHtml = '';

        /*
         * Build the form's input fields(e.g. text, password, email, select, radio)
         * based on user-injected form input-elements (built using class: FormText, FormEmail, FormPassword, FormSelect etc.).
         */
        $formElements = ''; // container for the form-HTML
        if(!empty($this->formElements)) { // $this->formElements is an array of FormInterface-type objects
            foreach($this->formElements as $element) {
                $formElements .= $element . "\n"; // build (input fields) HTML
            }
        }

        /*
         * If $action === null, user wants no action attribute at all - e.g. use xhr (AJAX).
         */
        $actionAttrib = <<<HEREDOC
action="$action"
HEREDOC;
        $action = $action ?? "";

        $formOpen = <<<HEREDOC
        <div class="bs-docs-section">
        <div class="bs-component">
        <form id="$formId" method="$method" $action class="form-horizontal">
        <fieldset>\n
        $formElements
        </fieldset>
HEREDOC;

        if ($backHref) {
            $backButton = <<<HEREDOC
        <button type="button" class="btn btn-primary pull-right" onclick="location.href='$backHref';">$backDisplay</button>\n
HEREDOC;
        } else {
            $backButton = '';
        }

        /**
         * a normal submit button, or a confirmation button with dialog (e.g. are you sure? 'confirm', 'cancel')
         * we thus define: '$normalSubmit' and '$confirmSubmit' html and store the appropriate html in '$submitButton'
         */

        $normalSubmit = <<<HEREDOC
        <button type="submit" name="$submitName" class="btn btn-primary">$submitDisplay</button>
HEREDOC;

        // $confirmationDialog
        $confirmAction = $confirmationDialog[2] ?? '';
        $href = ($confirmationDialog[1] === true) ? true : false; // a button (if false), or a href text (if true)
        $confirmSubmit = ($confirmationDialog[0] === true) ?
            $this->confirmationDialog($submitDisplay, $confirmAction, 'confirmationDialog', 'confirm', 'Please confirm...', $href) :
            false;

        /*
         * Use either a normal 'submit' button or in case of a confirmation dialog
         * a 'confirm' button.
         *
         * IMPORTANT: 'submit' or 'confirm'
         * The derault submit button has field-name 'submit',
         * whereas the 'confirmation' button default field-name is 'confirm',
         * so make sure to process the correct field-name in your action script.
         */
        $submitButton = ($confirmSubmit !== false) ? $confirmSubmit : $normalSubmit;

        // close form
        $formClose = <<<HEREDOC
        <div class="form-group">
            <div class="col-sm-offset-2 p-3 col-sm-10">
            $submitButton
            $backButton
            </div>
        </div>

        </fieldset>
        </form>
        </div>
        </div>\n\n
HEREDOC;

        // close form
        $formCloseNoSubmit = <<<HEREDOC
        </fieldset>
        </form>
        </div>
        </div>\n\n
HEREDOC;

        // set  $submitDisplay to false to render a form without a 'submit' button
        $formHtmlSubmit = $formOpen . $formFields . $formClose; // a submit button is required
        $formHtmlNoSubmit = $formOpen . $formFields . $formCloseNoSubmit; // no submit button is required
        $formHtml = ($submitDisplay !== false) ? $formHtmlSubmit : $formHtmlNoSubmit;


        $this->html = $formHtml;

        return $formHtml;
    }

    /**
     * Inject Bootstrap form element html into a form
     *
     * @param libs\FormInterface $formElement
     *
     * @return void
     */
    public function inject(libs\FormInterface $formElement): void
    {
        $this->formElements[] = $formElement->html;
    }


    /**
     * @param string $submitDisplay     set it to false if no form submit button should be rendered, anything else will
     *                                  be displayed on button a typical use-case for a form without a submit button is
     *                                  where we substitute it for a confirmDialog button (are you sure...) where
     *                                  field-name 'submit' becomes 'confirm' (e.g. delete actions, where we need to be
     *                                  sure this is what user wants).
     *
     * @param array $inputFields        array with attributes/properties for each form input-field:
     *                                  ['type', 'name', 'id', 'value', 'placeholder', 'label', options[]]
     *
     *                                  - 'type' can be: 'text', 'email', 'password', 'select', 'radio', 'checkbox', or 'file'.
     *                                  (ref: https://developer.mozilla.org/en-US/docs/Learn/Forms/HTML5_input_types)
     *
     *                                  - 'name' is the reference to retrieve the user-input in the $_POST(default) or $_GET array
     *
     *                                  - 'id' is the identifier (e.g. javascript or CSS reference)
     *
     *                                  - 'value' is the initial value that can be set in the input box (useful in setting 'hidden' input box values).
     *
     *                                  - 'placeholder' shows in the input field as a 'hint'
     *
     *                                  - 'options[] - e.g. set 'required' on a field, or define select-list-items, or set checked on a default choice radio button.
     *                                  options[0] : can be set to 'required'
     *
     */

    /**
     * @param array         $inputFields            : ['type', 'name', 'id', 'value', 'placeholder', 'label', options[]]
     * @param string        $submitDisplay          : the text displayed on the submit button
     * @param string        $submitName             : the name-field for the submit button (use different if > 1 form on a page)
     * @param string        $method                 : POST(form data sent as the request body) or GET(form data appended to the action URL with a ? separator)
     * @param string|bool   $action                 : the script that gets invoked on submit, or if 'false' no action at all(no page refresh)
     * @param string        $formId                 : the #id of the form
     * @param bool          $backHref               : a back-button href link
     * @param string        $backDisplay            : the text displayed on the back button (defaults to 'Back')
     * @param array         $confirmationDialog     : [0] == false, no confirmation dialog triggered
     *                                                [1] == true, 'text-href' [1] == false, 'button-href'
     *                                                [2] the target script that is invoked on 'confirm' or 'cancel' (there are two submit buttons)
     *
     * @return string                               : the form html
     */
    public function form($inputFields = [], $submitDisplay = 'submit', $submitName = 'submit', $method = 'POST', $action = "#", $formId = "formId", $backHref = false, $backDisplay = 'Back', $confirmationDialog = [false, true, ''])
    {
        /**
         * If $action === false, user wants no action attribute at all - i.e. use xhr (AJAX).
         * Until HTML5, the action attribute was required. This is no longer needed.
         * This way user can use Ajax to send data to the server without a page refresh.
         */
        $actionAttrib = <<<HEREDOC
action="$action"
HEREDOC;
        $action = ($action !== false) ? $actionAttrib : "";

        $formOpen = <<<HEREDOC
        <div class="bs-docs-section">
        <div class="bs-component">
        <form id="$formId" method="$method" $action class="form-horizontal">
        <fieldset>\n
HEREDOC;

        $formFields = null;

        /*
         * $inputFields[]
         *    [0]     [1]    [2]    [3]         [4]         [5]       [6]
         * ['type', 'name', 'id', 'value', 'placeholder', 'label', options[]]
         *
         * for type: text, password, email or hidden use options[0] to set 'required'
         */
        $inputFields = $inputFields ?? [];
        foreach ($inputFields as $key => $value) {
            $type = $value[0] ?? "";
            $name = $value[1] ?? "";
            $id = $value[2] ?? $name; // if id is not set, then set it equal to $name
            $fieldValue = $value[3] ?? ""; // can be useful to set initial value or for hidden form fields where a field value can be carried-over to next page
            $placeholder = $value[4] ?? "";
            $label = ($type !== 'hidden') ? $value[5] : "";
            $options = $value[6] ?? null; // $value[6] contains an array with options(e.g. to set 'required' or for select or radio buttons)

            /* type: text, password, email or hidden */
            if ($type === 'text' || $type === 'password' || $type === 'email' || $type === 'hidden') {
                /* hidden form fields may not take screen space */
                $style = ($type === 'hidden') ? "style='display: none'" : null;
                $formFields .= <<<HEREDOC
        <div class="form-group" $style>
            <label for="$id" class="col-sm-4 control-label">$label</label>
            <div class="col-sm-8">
            <input type="$type" class="form-control" name="$name" id="$id" value="$fieldValue" placeholder="$placeholder" $options[0]>
            </div>
        </div>\n
HEREDOC;
            }

            /* type textarea */
            if($type === 'textarea') {
                $formFields .= <<<HEREDOC
        <div class="form-group">
            <label for="$id" class="col-sm-4 control-label">$label</label>
            <div class="col-sm-8">
            <textarea class="form-control" id="$id" name="$name" rows="10" $options[0]>$fieldValue</textarea>
            </div>
        </div>
HEREDOC;
            }

            /** type: select */
            if ($type === 'select') {
                $formFields .= <<<HEREDOC
        <div class="form-group">
            <label for="$id" class="col-sm-4 control-label">$label</label>
            <div class="col-sm-8">
            <select class="form-control" id="$id" name="$name">\n
HEREDOC;
                foreach ($options as $option) {
                    $formFields .= <<<HEREDOC
                <option>$option</option>\n
HEREDOC;
                }

                $formFields .= <<<HEREDOC
            </select>
            </div>
        </div>\n
HEREDOC;
            }

            /** type: radio */
            if ($type === 'radio') {
                $formFields .= <<<HEREDOC
        <fieldset class="form-group">
HEREDOC;
                foreach ($options as $key => $value) {
                    $formFields .= <<<HEREDOC
        <div class="form-check">
            <label class="form-check-label">
            <div class="col-sm-10">
                <input type="radio" class="form-check-input" name="$name" id="$id" value="$key" $value>
                $key
            </div> 
            </label>
        </div>\n
HEREDOC;
                }
                $formFields .= <<<HEREDOC
        </fieldset>
HEREDOC;
            }
        }

        if ($backHref) {
            $backButton = <<<HEREDOC
        <button type="button" class="btn btn-primary pull-right" onclick="location.href='$backHref';">$backDisplay</button>\n
HEREDOC;
        } else {
            $backButton = '';
        }

        /**
         * a normal submit button, or a confirmation button with dialog (e.g. are you sure? 'confirm', 'cancel')
         * we thus define: '$normalSubmit' and '$confirmSubmit' html and store the appropriate html in '$submitButton'
         */

        $normalSubmit = <<<HEREDOC
        <button type="submit" name="$submitName" class="btn btn-primary">$submitDisplay</button>
HEREDOC;

        // $confirmationDialog
        $confirmAction = $confirmationDialog[2] ?? '';
        $href = ($confirmationDialog[1] === true) ? true : false; // a button (if false), or a href text (if true)
        $confirmSubmit = ($confirmationDialog[0] === true) ?
            $this->confirmationDialog($submitDisplay, $confirmAction, 'confirmationDialog', 'confirm', 'Please confirm...', $href) :
            false;

        /*
         * Use either a normal 'submit' button or in case of a confirmation dialog
         * a 'confirm' button.
         *
         * IMPORTANT: 'submit' or 'confirm'
         * The derault submit button has field-name 'submit',
         * whereas the 'confirmation' button default field-name is 'confirm',
         * so make sure to process the correct field-name in your action script.
         */
        $submitButton = ($confirmSubmit !== false) ? $confirmSubmit : $normalSubmit;

        // close form
        $formClose = <<<HEREDOC
        <div class="form-group">
            <div class="col-sm-offset-2 p-3 col-sm-10">
            $submitButton
            $backButton
            </div>
        </div>

        </fieldset>
        </form>
        </div>
        </div>\n\n
HEREDOC;

        // close form
        $formCloseNoSubmit = <<<HEREDOC
        </fieldset>
        </form>
        </div>
        </div>\n\n
HEREDOC;

        // set  $submitDisplay to false to render a form without a 'submit' button
        $formHtmlSubmit = $formOpen . $formFields . $formClose; // a submit button is required
        $formHtmlNoSubmit = $formOpen . $formFields . $formCloseNoSubmit; // no submit button is required
        $formHtml = ($submitDisplay !== false) ? $formHtmlSubmit : $formHtmlNoSubmit;

        $this->html = $formHtml;

        return $formHtml;
    }
}