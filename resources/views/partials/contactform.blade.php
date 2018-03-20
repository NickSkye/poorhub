<div id="contactform" class="container pull-out-container-contact">

    <div class="col-sm-6 col-sm-offset-3">
        <div class="row">
            <h2>Contact Us Today!</h2>
            <i class="fa fa-times fa-2x" id="contact-close" style="position: absolute; top: 5%; right: 5%;"
               aria-hidden="true"></i>
        </div>

        <form action="/sendemail" class="contact-form" method="post">
            {{ csrf_field() }}
            <div class="form-group">

                <input type="text" class="form-control" id="name" name="name" placeholder="Name">
            </div>

            <div class="form-group">

                <input type="email" class="form-control" id="email" name="email" placeholder="Email">
            </div>

            <div class="form-group">

                    <textarea class="form-control" id="messbody" name="messbody" placeholder="Message"
                              rows="4"></textarea>
            </div>

            <br>
            <button href="#" class="link-cta" role="button">Submit</button>
            {{--<button class="btn btn-primary btn-lg">Submit</button>--}}
        </form>
    </div>
</div>