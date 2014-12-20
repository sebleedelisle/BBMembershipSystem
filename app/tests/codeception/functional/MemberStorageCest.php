<?php
use \FunctionalTester;

class MemberStorageCest
{
    public function _before(FunctionalTester $I)
    {
    }

    public function _after(FunctionalTester $I)
    {
    }

    public function memberCanVisitStoragePage(FunctionalTester $I)
    {
        $I->am('a member');
        $I->wantTo('make sure I can view the member box page');

        //Load and login a known member
        $user = User::find(1);
        Auth::login($user);

        $I->haveEnabledFilters();

        //I can see the menu item
        $I->amOnPage('/storage_boxes');
        $I->canSee('Member Storage Boxes');

        $I->cantSee($user->name);

        //Make sure the message about paying for a box is displayed
        $I->canSee('5 deposit');

    }

    public function memberCanClaimBox(FunctionalTester $I)
    {
        $I->am('a member');
        $I->wantTo('make sure I can claim a box');

        //Load and login a known member
        $user = User::find(1);
        Auth::login($user);

        $I->haveEnabledFilters();

        //Create a box payment
        $paymentId = $I->haveInDatabase('payments', ['user_id'=>$user->id, 'reason'=>'storage-box', 'source'=>'other', 'amount'=>5.00, 'status'=>'paid']);
        $user->storage_box_payment_id = $paymentId;
        $user->save();

        $I->amOnPage('/storage_boxes');

        //Make sure it has seen our payment
        $I->see('It looks like we have a box available');

        //Claim a box
        $I->see('Claim');
        $I->click('Claim');

        //The page should now have our name next to the claimed box
        $I->see($user->name);
        $I->see('You have box');
    }
}