<template>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Flight Information</h1>
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Name airline</th>
                <th scope="col">Iata</th>
                <th scope="col">Departure Airport</th>
                <th scope="col">Arrival Airport</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="flight in flights" :key="flight.flight.iata">
                <td>{{ flight.airline.name }}</td>
                <td>{{ flight.flight.iata }}</td>
                <td>{{ flight.departure.airport }}</td>
                <td>{{ flight.arrival.airport }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import { usePage } from '@inertiajs/inertia-vue3';

export default {
    data() {
        return {
            flights: []
        };
    },
    mounted() {
        this.fetchFlights();
    },
    methods: {
        async fetchFlights() {
            try {
                const response = await fetch('/flights'); // Путь должен соответствовать вашему маршруту в Laravel
                const data = await response.json();
                this.flights = data.data; // Проверьте, что вы правильно обращаетесь к данным
            } catch (error) {
                console.error("Error fetching flights:", error);
            }
        }
    }
};
</script>

<style>
/* Добавьте свои стили здесь */
</style>
