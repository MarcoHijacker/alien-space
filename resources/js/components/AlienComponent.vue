<template>
    <div class="container d-flex justify-content-center">
        <div class="my-3 text-center">
            <img :src="image" class="alien_img">
            <h4 class="my-1">Name: {{ name }}</h4>
            <select @change="update">
                <option
                    v-for="col in ['red', 'green']"
                    :value="col"
                    :key="col"
                    :selected="col === color ? 'selected' : ''"
                >{{ col }}</option>
            </select>
            <button @click="del">Delete</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['id', 'color', 'name'],
        computed: {
            image() {
                return '/images/' + this.color + '.png';
            }
        },
        mounted() {
            console.log('Component mounted.');
        },
        methods: {
            update(event) {
                this.$emit('update', this.id, event.target.selectedOptions[0].value);
            },
            del() {
                this.$emit('delete', this.id);
            }
        }
    }
</script>

<style>
    .alien_img {
        width: 5em;
        height: auto;
    }
</style>