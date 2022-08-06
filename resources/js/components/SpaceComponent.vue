<template>
    <div class="container">
        <!-- Una serie di alien-component in v-for -->
        <alien-component
            v-for="alien in aliens"
            :id="alien.id"
            :name="alien.name"
            :color="alien.color"
            :key="alien.id"
            @update="update"
            @delete="del"
        >
        </alien-component>
        <hr>
        <div class="text-center">
            <div>Generate New Alien:</div>
            <button @click="create">Make a new life!</button>
        </div>
    </div>
</template>

<script>
    import AlienComponent from "./AlienComponent.vue";
    import axios from 'axios';

    export default {
        components: {
            AlienComponent,
        },
        data() {
            return {
                aliens: [],
            };
        },
        mounted() {
            console.log('Component mounted.')
        },
        created() {
            // Da riempire...
            this.read();
        },
        methods: {
            // Create (creazione casuale di un alieno)
            async create() {
                const data = await axios.get("/api/aliens/create");
                this.aliens.push(data.data);
            },
            // Index/read (ottengo tutti i records alieni)
            async read() {
                const data = await axios.get("/api/aliens");
                data.data.forEach(alien => this.aliens.push(alien));
            },
            // Update function
            async update(id, color) {
                await axios.put("/api/aliens/" + id, { 'color': color });
                this.aliens.find((alien) => alien.id === id).color = color;
            },
            // Delete
            async del(id) {
                await axios.delete("/api/aliens/" + id);
                // Prima devo trovare l'elemento dell'array con indice id:
                let index = this.aliens.findIndex((alien) => alien.id === id);
                // Splice:
                this.aliens.splice(index, 1);
            }
        }
    }
</script>
