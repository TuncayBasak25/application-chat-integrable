<?php

class HomePageView
{
  public static function display()
  {
    ?>
      <section id="head_bar">
        <?php
        if (isset($_SESSION['user_id']) === FALSE) {
          echo HeadBarView::display();
        }
        else {
          echo LoggedHeaderView::display();
        }
        ?>
      </section>
      <section id="main_section" class="d-flex">
        <section id="side_bar" class="col-2">
          <?php SideBarView::display(); ?>
        </section>
        <section id="main_board" class="col-10">
          <?php MainBoardView::display(); ?>
        </section>
      </section>
    <?php
  }
}
