<section class="form-group" id="contact"> <!-- Added 'pt-5' for padding-top and 'pb-5' for padding-bottom -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <iframe width="600" height="450" style="border:0" loading="lazy" allowfullscreen src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJcSUTOAbdwogRIVfLYNgMVhU&key=AIzaSyAttEU47UqcsjCL5gTSW1qZOXgkX-mHhKo"></iframe>
            </div>
            <div class="col-md-6 py-100 px-50">
                <h2 class="contact-title text-center mb-4">{{ 'Contact Us' }}</h2>
                <!-- Optional: Added 'mb-4' for a little margin below the title -->
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" placeholder="Enter name">
                                <small id="nameHelp" class="form-text text-muted">Please enter a name we can
                                    refer you as.</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" placeholder="Enter email">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email
                                    with anyone else.</small>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Message</label>
                            <textarea class="form-control"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</section>
