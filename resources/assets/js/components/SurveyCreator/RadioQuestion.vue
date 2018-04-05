<template lang="html">
    <div id="custom-question-content">
        <h6 class="card=subtitle">Response Type</h6>
        <div class="form-check mb-3">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" :name="question.id" id="exampleRadios1" value="radio" v-model="question.type" checked>
                Radio
            </label>
            <label class="form-check-label">
                <input class="form-check-input" type="radio" :name="question.id" id="exampleRadios2" value="checkbox" v-model="question.type">
                Checkbox
            </label>
        </div>
        <h6 class="card=subtitle">Response Choices</h6>
        <div class="input-group" v-for="choice in this.question.choices" :key="choice.id">
            <input type="text" placeholder="Choice Text" class="form-control" aria-describedby="" v-model="choice.text" v-bind="choice">
            <button type="button" class="close float-right" aria-label="Close" @click="destroyChoice(choice.id)">
            </button>
        </div>
        <div class="btn-group-vertical mt-3">
            <button class="btn btn-success" @click="addNewRadioChoice">New Choice</button>
        </div>
        <hr>
        <div id="container-skip-logic" v-if="this.question.hasOwnProperty('dependents')">
            <skip-logic class="skip-logic" :id="'skip-logic-' + question.id" :question="question"></skip-logic>
            <button :id="'btn-skip-logic-' + question.id" class="btn btn-secondary mt-2" @click="toggleSkipLogic">Add Dependent Questions</button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            lastId: 0,
            skipLogicVisible: false
        }
    },
    props: ['question'],
    methods: {
        destroyChoice(id) {
            for(var i = 0; i < this.question.choices.length; i++) {
                if(this.question.choices[i].id == id) {
                    this.question.choices.splice(i, 1);
                }
            }
        },
        addNewRadioChoice() {
            this.question.choices.push({
                id: this.lastId++,
                text: null
            });
        },
        toggleSkipLogic() {
            var skipLogicElement = '#skip-logic-' + this.question.id;
            var skipLogicButton = '#btn-skip-logic-' + this.question.id;

            if(this.skipLogicVisible) {
                $(skipLogicElement).hide();

                this.question.dependents = {
                    condition: null,
                    response: null,
                    questions: []
                }

                $(skipLogicButton).removeClass('btn-danger');
                $(skipLogicButton).addClass('btn-secondary');
                $(skipLogicButton).html('Add Dependent Questions');
            } else {
                $(skipLogicElement).show();

                $(skipLogicButton).removeClass('btn-secondary');
                $(skipLogicButton).addClass('btn-danger');
                $(skipLogicButton).html('Cancel');
            }
            this.skipLogicVisible = !this.skipLogicVisible;

            this.scrollScreenDown(skipLogicElement);
        },
        scrollScreenDown(skipLogicElement) {
            setTimeout(function(){
                $("html, body").animate({ scrollTop: $(skipLogicElement).offset().top });
            }, 0.5);
        }
    }
}
</script>

<style lang="css">
.skip-logic {
    display: none;
}
</style>
