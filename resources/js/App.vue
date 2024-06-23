<template>
    <h1>{{ this.headline }}</h1>

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
                    &#10060; gekauft
                </button>
            </div>
        </div>

</template>

<script>
export default {

    name: 'App',
    components:{

    },
    data(){
        return {
            headline: "Einkäufe ToDo",
            grocerieList: undefined,
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
    },
    created(){
        this.getGrocerieList();
    }
}
</script>

<style lang="scss">
*{
    margin:0;
    padding:0;
    text-align:center;
}
body{
    padding:25px 50px;
}
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
        padding:12px;
        margin-top:25px;
        font-size:16px;
        cursor:pointer;
    }
}
.grocerie_list_item_active{
    font-size:18px;
    font-weight:bold;
    border:1px solid #FF0000;
    background:#fff;
}
</style>
