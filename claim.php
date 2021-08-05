<div class="contact---area">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <!-- Contact Area -->
                            <div class="contact-form-area contact-page">
                                <h4 class="mb-50 text-dark"><i class="fa fa-home"></i> Claim your property</h4>
                                <p>Please kindly fill in the box if you want to make full payment</p>

                                
                                <form action="/contact.php" method="post">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <input type="text" name="name_real" class="form-control" id="name" placeholder="Your Name">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <input type="email" name="email_real" class="form-control" value="<?php echo $clientemail ?>" id="email" placeholder="Your E-mail">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <input type="tel" name="phone" class="form-control" id="phone" placeholder="Your Phone" value="<?php echo $Userphone ?>">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <select type="text" name="subject" class="form-control" id="subject" placeholder="House type">
                                                    <option selected>Select House Type</option>
                                                    <option>A</option>
                                                    <option>B</option>
                                                    <option>C</option>
                                                    <option>D</option>
                                                    <option>E</option>
                                                    <option>F</option>
                                                    <option>G</option>
                                                    <option>H</option>
                                                    <option>I</option>
                                                    <option>J</option>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <textarea name="comment" class="form-control" id="message" cols="30" rows="10" placeholder="Your Message"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-info" name="contact" type="submit"><i class="fa fa-send"></i> Claim</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

