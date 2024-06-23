<template>
    <h1 v-html="this.headline"></h1>

        <div
            v-for="grocerie in this.grocerieList"
            class="grocerie_list_item"
            @click="grocerie.expanded = !grocerie.expanded"
            :class="{ grocerie_list_item_active : grocerie.expanded }"
        >
            {{ grocerie.name }}
            <div v-if="grocerie.expanded">
                <button
                    @click="removeFromGrocerieList(grocerie.id)"
                >
                    &#9989;
                </button>
            </div>
        </div>

        <div class="grocerie_new">
            <input type="text" placeholder="Hinzufügen" v-model="newGrocerie">
            <button class="add" @click="addToGrocerieList()">&raquo;</button>
        </div>

</template>

<script>
export default {

    name: 'App',
    components:{

    },
    data(){
        return {
            headline: "&#128722; Einkäufe &#128717;",
            grocerieList: undefined,
            newGrocerie: undefined,
        }
    },
    methods: {
        getGrocerieList(){
            axios
            .get('/api/items')
            .then((response) => {
                this.grocerieList = response.data;
            });
        },
        removeFromGrocerieList(id=0){
            axios
            .put('/api/item/' + id)
            .then((response) => {
                this.grocerieList = response.data;
            });
        },
        addToGrocerieList(){
            if(this.newGrocerie){
                let jsonInput='{"item":{"name":"' + this.newGrocerie + '"}}';

                axios
                .post('/api/item/store', jsonInput, {
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then((response) => {
                    this.grocerieList = response.data;
                });

                this.newGrocerie=undefined;
            }
        }
    },
    created(){
        this.getGrocerieList();
    }
}
</script>

<style lang="scss">
h1{
    padding-bottom:25px;
    border-bottom:1px solid #000;
}
.grocerie_list_item{
    font-size:16px;
    padding:12px;
    margin:12px 0px;
    border-radius:12px;
    border:1px solid #d0d0d0;
    text-transform:uppercase;
    cursor:pointer;
    background:#f0f0f0;

    button{
        padding:3px;
        margin-top:25px;
        font-size:25px;
        cursor:pointer;
        background:#7cb342;
        border:0px;
    }
}
.grocerie_list_item_active{
    font-size:18px;
    font-weight:bold;
    border:2px solid #7cb342;
    background:#fff;
}
.grocerie_new{
    width:100vw;
    padding-top:40px;
    min-height:100px;
    background:#444;
    position:fixed;
    left:0;
    bottom:0;
    opacity: 0.89;
    -webkit-box-shadow: 0px 0px 27px 1px rgba(0,0,0,0.4);
    box-shadow: 0px 0px 27px 1px rgba(0,0,0,0.4);

    input{
        display:inline;
        font-size:19px;
        width:50%;
        height:50px;
    }

    button{
        display:inline;
        font-size:19px;
        width:15%;
        height:54px;
    }
}

</style>
