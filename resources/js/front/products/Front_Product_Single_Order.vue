
<template>
    <div class="feature-card border">
        <div class="feature-media">
            <q-img class="for-img" src="https://tamkins.com/wp-content/uploads/2022/11/Layer-14-1200x1200.png"  alt="product" />
        </div>
        <div class="feature-content text-left">
            <h6 class="product-name ">
                <a href="" class="text-dark">قهوه 50-50 تام کینز</a>
            </h6>
            <div class="mt-2 mobile-price">
                160,000<small> تومان </small>
            </div>
            <div class="mt-3">
                <span class="quantity-title">تعداد : </span>
                <q-chip color="red" square text-color="white" class="quantity-value">1</q-chip>
            </div>
            <strong class="float-right comment-text text-blue-7">
                <q-icon name="fas fa-comment ms-1"></q-icon>
                ثبت دیدگاه
            </strong>
            <q-dialog
                v-model="CommentDialog"
            >
                <q-card style="width: 700px; max-width: 80vw;">
                    <q-card-section>
                        <div class="text-h6">Medium</div>
                    </q-card-section>

                    <q-card-section class="q-pt-none">
                        Click/Tap on the backdrop.
                    </q-card-section>

                    <q-card-actions align="right" class="bg-white text-teal">
                        <q-btn flat label="OK" v-close-popup />
                    </q-card-actions>
                </q-card>
            </q-dialog>

        </div>
    </div>
</template>

<style scoped>
.for-img {
    width: 150px;
}
.product-name{
    font-size: 15px;
}
.product-rating > i{
    font-size: 12px !important;
}

.mobile-price{
    font-size: 16px;
    font-weight: 500;

}
.quantity-title{
    font-size: 12px;
    font-weight: 500;
}
.quantity-value{
    font-size: 11px;
    font-weight: 700;
}
.comment-text{
 font-size: 13px;
}
@media only screen and (max-width: 600px) {
    .for-img {
        width: 90px;
    }
    .product-name{
        font-size: 13px;
    }
    .product-rating > i{
        font-size: 10px !important;
    }
    .mobile-price{
        font-size: 14px;
        font-weight: 500;
        color: #1b9124;
    }
    .product-add > i{
        display: block;
        font-size: 10px;
    }
    .action-input .action-plus .action-minus{
        font-size: 12px !important;
    }
}
</style>
<script>
import {defineComponent} from 'vue'

export default defineComponent({
    name: "Front_Product_Single_Order",
    data(){
        return {
            CommentDialog:[],
        }
    }
})
</script>
