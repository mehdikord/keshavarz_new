
<template>
    <section class="inner-section">
        <div class="container mt-4 mb-3">
            <span class="text-muted">صفحه اصلی </span>
            /
            <span class="text-muted"> قهوه ها </span>
            /
            <span class="text-dark">قهوه ربستا</span>

        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <q-carousel
                        swipeable
                        animated
                        v-model="slide"
                        thumbnails
                        infinite
                        class="for-main-slider"
                    >
                        <q-carousel-slide :name="1" img-src="https://tamkins.com/wp-content/uploads/2022/11/Layer-7.png" />
                        <q-carousel-slide :name="2" img-src="https://tamkins.com/wp-content/uploads/2022/11/Layer-6.png" />
                        <q-carousel-slide :name="3" img-src="https://tamkins.com/wp-content/uploads/2022/11/Layer-12.png" />
                        <q-carousel-slide :name="4" img-src="https://tamkins.com/wp-content/uploads/2022/11/Layer-11.png" />
                    </q-carousel>
                </div>
                <div class="col-lg-6">
                    <div class="details-content">
                        <h3 class="details-name"><a href="#">نام محصول اینجاست</a></h3>
                        <div class="">
                            <div>
                                <span>دسته بندی : </span>
                                <strong>
                                    قهوه ها
                                </strong>
                            </div>
                            <div class="mt-2">
                                <span>برند : </span>
                                <strong>
                                    تام کینز
                                </strong>
                            </div>
                        </div>
                        <div class="details-rating mt-2">
                            <i class="active icofont-star"></i>
                            <i class="active icofont-star"></i>
                            <i class="active icofont-star"></i>
                            <i class="active icofont-star"></i>
                            <i class="icofont-star"></i>
                            <a class="rate-review" href="#">(3 دیدگاه)</a>
                        </div>
                        <h3 class="mt-2">
                            <strong class="price me-3 text-success">185,000</strong>
                            <del class="price-old text-danger">200,000</del>
                            <span class="me-1 curency">تومان</span>
                        </h3>
                        <p class="details-desc mt-1 text-justify">
                            قَهوه، گونه‌ای نوشیدنی رایج است که از دانه‌های بوداده و آسیاب‌شدهٔ گیاه قهوه به‌دست می‌آید. قهوه کمی اسیدی است و به‌علت داشتن کافئین بالا، یک ماده محرک است.[۱] این نوشیدنی، محبوب‌ترین نوشیدنی گرم در جهان است.[۲
                        </p>
                        <div class="details-list-group">
                            <q-icon name="fas fa-thumbs-up" color="success"></q-icon>
                            <small class="me-2">87% کاربران از خرید این محصول راضی هستند !</small>

                        </div>
                        <div class="details-list-group"><label class="details-list-title">اشتراک گذاری : </label>
                            <ul class="details-share-list">
                                <li><a href="#" class="icofont-facebook" title="Facebook"></a></li>
                                <li><a href="#" class="icofont-twitter" title="Twitter"></a></li>
                                <li><a href="#" class="icofont-linkedin" title="Linkedin"></a></li>
                                <li><a href="#" class="icofont-instagram" title="Instagram"></a></li>
                            </ul>
                        </div>
                        <div class="details-add-group">
                            <div class="row ">
                                <div class="col-9 m-0">
                                    <button class="product-add" title="افزودن به سبد خرید">
                                        <span>افزودن به سبد خرید</span>
                                        <q-icon name="fas fa-cart-arrow-down" class="me-2" size="20px"></q-icon>
                                    </button>
                                    <div class="product-action">
                                        <button class="action-minus" title="Quantity Minus">
                                            <i class="icofont-minus"></i>
                                        </button>
                                        <input class="action-input" title="Quantity Number" type="text" name="quantity" value="1">
                                        <button class="action-plus" title="Quantity Plus"><i class="icofont-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-3 m-0">
                                    <button class="product-add" title="افزودن به سبد خرید">
                                        <span>علاقه مندی</span>
                                        <q-icon name="fas fa-cart-arrow-down" class="me-2" size="20px"></q-icon>

                                    </button>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="inner-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-details-frame">
                        <h3 class="frame-title">Description</h3>
                        <div class="tab-descrip">
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequatur, ex! Incidunt nemo
                                aspernatur fugiat, saepe suscipit sit perferendis illum magnam voluptates aliquid
                                blanditiis, dolor assumenda dolorem ullam harum, doloribus molestiae! Unde voluptas
                                maiores exercitationem aperiam debitis accusantium, placeat vero neque, atque eius
                                numquam incidunt, culpa a odit consequatur nostrum aut nisi quisquam sequi dignissimos
                                sed. Odio necessitatibus officiis repudiandae omnis soluta fugiat aliquam eius quae.
                                Unde, ipsam atque assumenda consequuntur quia alias nulla, cupiditate ab quos eveniet
                                pariatur expedita repellendus fugit. Quisquam fuga et, dolore aut temporibus atque
                                itaque nesciunt reiciendis nobis, deleniti nihil vel qui perferendis molestias aliquam
                                doloremque.</p>
                        </div>
                    </div>
                    <div class="product-details-frame">
                        <h3 class="frame-title">Spacification</h3>
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th scope="row">Product code</th>
                                <td>SKU: 101783</td>
                            </tr>
                            <tr>
                                <th scope="row">Weight</th>
                                <td>1kg, 2kg</td>
                            </tr>
                            <tr>
                                <th scope="row">Styles</th>
                                <td>@Girly</td>
                            </tr>
                            <tr>
                                <th scope="row">Properties</th>
                                <td>Short Dress</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="product-details-frame">
                        <h3 class="frame-title">Reviews (2)</h3>
                        <ul class="review-list">
                            <li class="review-item">
                                <div class="review-media"><a class="review-avatar" href="#"><img
                                    src="/front/images/avatar/01.jpg" alt="review"></a>
                                    <h5 class="review-meta"><a href="#">miron mahmud</a><span>June 02, 2020</span></h5>
                                </div>
                                <ul class="review-rating">
                                    <li class="icofont-ui-rating"></li>
                                    <li class="icofont-ui-rating"></li>
                                    <li class="icofont-ui-rating"></li>
                                    <li class="icofont-ui-rating"></li>
                                    <li class="icofont-ui-rate-blank"></li>
                                </ul>
                                <p class="review-desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus
                                    hic amet qui velit, molestiae suscipit perferendis, autem doloremque blanditiis
                                    dolores nulla excepturi ea nobis!</p>
                                <form class="review-reply"><input type="text"
                                                                  placeholder="reply your thoughts"><button><i
                                    class="icofont-reply"></i>reply</button></form>
                                <ul class="review-reply-list">
                                    <li class="review-reply-item">
                                        <div class="review-media"><a class="review-avatar" href="#"><img
                                            src="/front/images/avatar/02.jpg" alt="review"></a>
                                            <h5 class="review-meta"><a href="#">labonno khan</a><span><b>author
                                                        -</b>June 02, 2020</span></h5>
                                        </div>
                                        <p class="review-desc">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                            Ducimus hic amet qui velit, molestiae suscipit perferendis, autem doloremque
                                            blanditiis dolores nulla excepturi ea nobis!</p>
                                        <form class="review-reply"><input type="text"
                                                                          placeholder="reply your thoughts"><button><i
                                            class="icofont-reply"></i>reply</button></form>
                                    </li>
                                    <li class="review-reply-item">
                                        <div class="review-media"><a class="review-avatar" href="#"><img
                                            src="/front/images/avatar/03.jpg" alt="review"></a>
                                            <h5 class="review-meta"><a href="#">tahmina bonny</a><span>June 02,
                                                    2020</span></h5>
                                        </div>
                                        <p class="review-desc">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                            Ducimus hic amet qui velit, molestiae suscipit perferendis, autem doloremque
                                            blanditiis dolores nulla excepturi ea nobis!</p>
                                        <form class="review-reply"><input type="text"
                                                                          placeholder="reply your thoughts"><button><i
                                            class="icofont-reply"></i>reply</button></form>
                                    </li>
                                </ul>
                            </li>
                            <li class="review-item">
                                <div class="review-media"><a class="review-avatar" href="#"><img
                                    src="/front/images/avatar/04.jpg" alt="review"></a>
                                    <h5 class="review-meta"><a href="#">shipu shikdar</a><span>June 02, 2020</span></h5>
                                </div>
                                <ul class="review-rating">
                                    <li class="icofont-ui-rating"></li>
                                    <li class="icofont-ui-rating"></li>
                                    <li class="icofont-ui-rating"></li>
                                    <li class="icofont-ui-rating"></li>
                                    <li class="icofont-ui-rate-blank"></li>
                                </ul>
                                <p class="review-desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus
                                    hic amet qui velit, molestiae suscipit perferendis, autem doloremque blanditiis
                                    dolores nulla excepturi ea nobis!</p>
                                <form class="review-reply"><input type="text"
                                                                  placeholder="reply your thoughts"><button><i
                                    class="icofont-reply"></i>reply</button></form>
                            </li>
                        </ul>
                    </div>
                    <div class="product-details-frame">
                        <h3 class="frame-title">add your review</h3>
                        <form class="review-form">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="star-rating"><input type="radio" name="rating" id="star-1"><label
                                        for="star-1"></label><input type="radio" name="rating" id="star-2"><label
                                        for="star-2"></label><input type="radio" name="rating" id="star-3"><label
                                        for="star-3"></label><input type="radio" name="rating" id="star-4"><label
                                        for="star-4"></label><input type="radio" name="rating" id="star-5"><label
                                        for="star-5"></label></div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group"><textarea class="form-control"
                                                                      placeholder="Describe"></textarea></div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group"><input type="text" class="form-control" placeholder="Name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group"><input type="email" class="form-control"
                                                                   placeholder="Email"></div>
                                </div>
                                <div class="col-lg-12"><button class="btn btn-inline"><i
                                    class="icofont-water-drop"></i><span>drop your review</span></button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.for-main-slider{
    height: 600px;
}
.details-name{
    font-size: 18px;
    font-weight: 500;
}
.details-rating > i{
    font-size: 14px;
}
.rate-review{
    font-size: 12px;
}
.price{
    font-size: 26px;
}
.price-old{
    font-size: 24px;
}
.curency{
    font-size: 14px;
}
.details-content{
    padding-top: 18px;
}
</style>
<script>
import {defineComponent} from 'vue'

export default defineComponent({
    name: "Front_Product_Page",
    data(){
        return {
            slide : 1,
        }
    }
})
</script>
