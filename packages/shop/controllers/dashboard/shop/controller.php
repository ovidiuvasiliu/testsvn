<?php
defined('C5_EXECUTE') or die("Access Denied.");
class DashboardShopController extends Controller
{
    public function view()
    {
        $this->redirect('/dashboard/shop/manage');
    }

}
