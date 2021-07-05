<template>
    <section class="summary">
        <article class="row">
            <div class="col-md-10"><span>Total</span></div>
            <div class="col-md-2">
                <div v-bind:class="{'text-success':(this.summary.total >= 0), 'text-danger':(this.summary.total < 0)}">{{this.summary.total}}</div>
            </div>
        </article>
        <article class="row">
            <div class="col-md-10"><span>Invested</span></div>
            <div class="col-md-2">{{this.summary.invested}}</div>
        </article>
        <article class="row">
            <div class="col-md-10"><span>Performance</span></div>
            <div class="col-md-2">
                <div v-bind:class="{'text-success':(this.summary.performance >= 0), 'text-danger':(this.summary.performance < 0)}">{{this.summary.performance}}%</div>
            </div>
        </article>
    </section>
</template>

<script>
export default {
    data() {
        return {
            summary: {
                total: 0,
                invested: 0,
                performance: 0
            }
        }
    },
    props: {
        stocks: Array
    },
    methods: {
        generateSummary(items) {
            items.forEach((item) => {
                this.summary.total += item.profit;
                this.summary.invested += item.volume * item.purchase_price;
            });
            
            if (this.summary.invested > 0) {
                this.summary.performance = (this.summary.total / this.summary.invested) * 100;
                this.summary.performance = this.summary.performance.toFixed(2);
            }
        }
    },
    watch: {
        stocks: function (value) {
            this.generateSummary(value);
        }
    }
}
</script>
