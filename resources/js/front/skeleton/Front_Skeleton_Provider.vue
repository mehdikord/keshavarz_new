<script>
export default {
    name: "Front_Skeleton_Provider"
}
</script>

<template>

    <q-card class="bg-grey-1 rounded">
        <q-card-section class="q-pa-xs">
            <div class="row items-center">
                <div class="col-lg-2 col-sm-3 col-xs-3 q-pa-sm mobile-padding text-center">
                    <q-img  src="/front/images/farmer.png" class="image" />
                </div>
                <div class="col-lg-10 col-sm-9 col-xs-9 info-padding">
                    <div class="info-box">
                        <span class="info-title text-green-7">    <q-skeleton width="120px" /> </span>
                        <span class="info-text text-dark">  <q-skeleton width="130px" /></span>
                    </div>
                    <div class="info-box">
                        <q-skeleton  />
                    </div>
                    <div class="info-box">
                        <q-skeleton  />
                    </div>
                    <div class="info-box">
                        <q-skeleton  />
                    </div>
                    <div class="btn-box">
                        <q-skeleton class="float-right" width="80px" height="30px" />
                        <q-skeleton class="float-right q-mr-sm" width="100px" height="30px" />

                    </div>
                </div>
            </div>
        </q-card-section>
    </q-card>
</template>
<style scoped>
.mobile-padding{

}
.info-padding{
    padding-bottom: 8px;
    padding-right: 10px;
}
.info-btn{
    font-size: 13px;
}
.image{
    width: 100px;
}
.currency{
    font-size: 12px;
    margin-left: 4px;
}
.btn-box{
    margin-top: 10px;
}
.info-box{
    margin-top: 11px;
}
.info-title{
    font-size: 13px;
    font-weight: 600;
}
.info-text{
    font-size: 14px;
    font-weight: 600;
    margin-left: 3px;
}
.info-error{
    font-size: 13px;
    font-weight: 500;
    margin-left: 3px;
}

@media only screen and (max-width: 600px) {
    .mobile-padding{
        padding: 0 0;
    }
    .info-padding{
        padding-bottom: 3px;
        padding-right: 3px;
    }
    .info-btn{
        font-size: 12px;
    }
    .image{
        width: 70px;
    }
    .currency{
        font-size: 10px;
        margin-left: 4px;
    }
    .btn-box{
        margin-top: 16px;
    }
    .info-box{
        margin-top: 11px;
    }
    .info-title{
        font-size: 12px;
        font-weight: 600;
    }
    .info-text{
        font-size: 13px;
        font-weight: 600;
        margin-left: 3px;
    }
    .info-error{
        font-size: 12px;
        font-weight: 500;
        margin-left: 3px;
    }
}

</style>
