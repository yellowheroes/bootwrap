<?php
/**
 * Created by Yellow Heroes
 * User: Robert
 * Date: 18/09/2018
 * Time: 15:35
 */
namespace yellowheroes\bootwrap;

class Body
{
    public function __construct(BootWrap $bootWrap)
    {
        echo "<!-- start class Body generated HTML -->\n";
        echo "<body>";
        echo "<header><nav></nav></header>";
        echo "<main role='main' class='container'>";
        $bodyHtml = $bootWrap->jumbotron('yoohoo', 'there it is', 'enjoy BootWrap');
        echo $bodyHtml;

        $inputFields = [
            ['text', 'username', 'username', "", 'enter user name', 'your username', ['required']],
            ['password', 'password', 'password', "", 'password', 'your password', ['required']]
        ];
        $form = $bootWrap->form($inputFields, 'Sign In');
        echo $form;

        $inputFields = [
            ['text', 'username', 'username', "", 'enter user name', 'Your username', ['required']],
            ['password', 'password', 'password', "", 'enter password', 'Your password', ['required']],
            ['email', 'email', 'email', "", 'enter email address', 'Your email', null],
            ['select', 'usertype', 'usertype', "", 'select a user type', 'User type', ['editor', 'admin']]
        ];
        $form = $bootWrap->form($inputFields, 'Register User');
        echo $form;
    }

}
