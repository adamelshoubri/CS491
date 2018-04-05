<template lang="html">
    <div id="custom-question-content">
        <h6 class="card=subtitle">Matrix Properties</h6>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Radio Choice Type</label>
            <select class="form-control" id="" v-model="selected" @change="changeRadioChoiceType">
                <option value="-1" selected disabled hidden>Choose here</option>
                <option value="0">Very satisfied to very unsatisfied</option>
                <option value="1">Excellent to very poor</option>
                <option value="2">Strongly agree to strongly disagree</option>
                <option value="3">Extremely likely to extremely unlikely</option>
                <option value="4">Ratings 1 to 5</option>
                <!--TODO: ADD CUSTOM CHOICES <option value="5">Custom</option>-->
            </select>
        </div>
        <div class="input-group" v-for="choice in this.question.choices" :key="choice.id">
            <input type="text" placeholder="Item Text" class="form-control" aria-describedby="" v-model="choice.text" v-bind="choice">
            <button type="button" class="close float-right" aria-label="Close" @click="destroyItem(choice.id)">
            </button>
        </div>
        <button class="btn btn-success mt-3" @click="addNewItem()">New Item</button>
        <div v-if="this.question.radios.length > 0">
            <small class="form-text text-muted mt-3 mb-2 text-center mx-auto">Preview</small>
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th class="text-center" v-for="radio in this.question.radios"> {{ radio }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="choice in this.question.choices">
                        <td>{{ choice.text }}</td>
                        <td class="text-center" v-for="radio in question.radios"><input type="radio" :name="choice.id"></input></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            lastId: 0,
            selected: "-1",
            radioPresets: [
                {
                    id: 0,
                    choices: ['Very satisified',
                        'Somewhat satisfied',
                        'Neither satisfied nor dissatisfied',
                        'Somewhat unsatisfied',
                        'Very dissatisfied',
                        'N/A']
                },
                {
                    id: 1,
                    choices: ['Excellent',
                        'Good',
                        'Average',
                        'Below average',
                        'Poor',
                        'N/A']
                },
                {
                    id: 2,
                    choices: ['Strongly Agree',
                        'Agree',
                        'Neither agree nor disagree',
                        'Disagree',
                        'Strongly Disagree',
                        'N/A']
                },
                {
                    id: 3,
                    choices: ['Extremely likely',
                        'Likely',
                        'Neither likely nor unlikely',
                        'Unlikely',
                        'Extremely unlikely',
                        'N/A']
                },
                {
                    id: 4,
                    choices: ['1',
                        '2',
                        '3',
                        '4',
                        '5',
                        'N/A']
                },
                {
                    id: 5,
                    choices: [null, null, null, null, null]
                }
            ]
        }
    },
    props: ['question'],
    methods: {
        destroyItem(id) {
            for(var i = 0; i < this.question.choices.length; i++) {
                if(this.question.choices[i].id == id) {
                    this.question.choices.splice(i, 1);
                }
            }
        },
        addNewItem() {
            this.question.choices.push({
                id: this.lastId++,
                text: null
            });
        },
        getChoiceText() {
            console.log('test');
        },
        changeRadioChoiceType() {
            this.question.radios = this.radioPresets[this.selected].choices;
        }

    }
}
</script>

<style lang="css">
</style>
