<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CTCDB - Photograph Tagging</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <script src="https://unpkg.com/vue@latest"></script>
    <script src="https://unpkg.com/vue-select@2.6.0"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <style>
      .vs__selected-options {
        width: 300px !important;
      }
      .dropdown-toggle {
        background-color: white !important;
      }
      html, body, #app, .section {
        height: 100%;
      }
    </style>
  </head>
  <body>
    <div id="app">
      <section class="section" style="background-color: grey;">
        <div class="container" style="background-color: white;">
          <div class="columns">
            <div class="column" style="padding-top: 0px; padding-right: 0px;">
              <img :src="'https://ctc-members.dk/files/' + photograph.file_name">
              <div class="is-size-7" >
                <span v-if="photograph.uploader > 0">uploaded by @{{photograph.uploader.full_name}}</span>
                <span class="is-pulled-right" style="padding-right: 20px;">original file name: @{{photograph.original_file_name}}</span>
              </div>
            </div>
            <div class="column is-5" style="background-color: #eeeeee;">
              <!-- Photo Type Selection Field -->
              <div class="field is-horizontal">
                <div class="field-label is-normal">
                  <label class="label has-text-left">Type</label>
                </div>
                <div class="field-body">
                  <div class="field is-narrow">
                    <div class="control">
                      <div class="select is-fullwidth">
                        <select v-model="photograph.phototype_id" v-on:change="submitPhotograph">
                          <option
                            v-for="phototype in phototypes"
                            :value="phototype.id"
                          >
                            @{{phototype.name}}
                          </option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <!-- Project Tag -->
              <div class="field is-horizontal">
                <div class="field-label is-normal">
                  <label class="label has-text-left">Project</label>
                </div>
                <div class="field-body">
                  <div class="field is-narrow">
                    <div class="control">
                      <div class="select is-fullwidth">
                        <select v-model="projectTag.project_id" v-on:change="submitProjectTag">
                            <option
                              v-for="project in projects"
                              :value="project.id"
                            >
                            @{{project.name}}
                            </option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <!-- People Tags -->
              <div class="field is-horizontal">
               <div class="field-label is-normal">
                 <label class="label has-text-left">People</label>
               </div>
               <div class="field-body">
                 <table v-if="peopleTags.length > 0" class="table is-bordered is-fullwidth" style="width: 322px;">
                     <tr v-for="(personTag,key) in peopleTags">
                       <td>
                          @{{personTag.person.full_name}}
                          <button
                                style="padding:0;border:none;background: none; padding-top: 2px;"
                                class="has-text-danger is-size-6 is-pulled-right"
                                v-on:click="deletePersonTag(personTag.id,key)"
                          >
                            <i class="fas fa-minus-circle"></i>
                          </button>
                       </td>
                     </tr>
                 </table>
                 <div v-else>
                   <v-select ref="mySelect" :options="people" label="full_name" taggable v-model="personSelected" placeholder="+ tag new person" v-on:change="addPersonTag"></v-select>
                 </div>
               </div>
             </div>
             <div v-if="peopleTags.length > 0" class="field is-horizontal">
               <div class="field-label is-normal"></div>
               <div class="field-body">
                 <v-select ref="mySelect" :options="people" label="full_name" taggable v-model="personSelected" placeholder="+ tag new person" v-on:change="addPersonTag"></v-select>
               </div>
             </div>
              <!-- Tag Completion Box -->
              <div class="field is-horizontal">
                <div class="field-label">
                  <!-- <label class="label">Tagging is complete</label> -->
                </div>
                <div class="field-body">
                  <div class="field">
                    <div class="control">
                      <label class="checkbox">
                        <input value="1" type="checkbox" v-model="photograph.is_tagged" v-on:change="submitPhotograph">
                        tagging is complete
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <!-- Photographer -->
              <div class="field is-horizontal">
                    <div class="field-label">
                      <label class="label has-text-left">Photo by</label>
                    </div>
                    <div class="field-body">
                      <div class="control">
                          <v-select :options="people" label="full_name" taggable v-model="photograph.photographer" placeholder="photographer" v-on:input="addPhotographer"></v-select>
                      </div>
                    </div>
              </div>
              <hr>
              <!-- Deletion Button -->
              <button type="button" class="button is-danger is-outlined" v-on:click="deletePhotograph">
                Delete Photograph
              </button>
              <button type="button" class="button is-info is-pulled-right"
                      onclick="window.open('', '_self', ''); window.close();">
                      Close Window
              </button>
              <hr>
              <div class="has-text-centered">

                <p class="is-size-7">(changes are saved automatically)</p>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    <script>
      Vue.component('v-select', VueSelect.VueSelect);
      axios.defaults.headers.common = {
          'X-CSRF-TOKEN': "{{csrf_token()}}"
      };
      new Vue({
        el: '#app',
        data:{
          options:[
            @foreach($people as $person)
            '{{$person->full_name}}',
            @endforeach
          ],
          personSelected: null,
          photograph: {!! json_encode($photograph) !!},
          projectTag: {!! json_encode($phototag_project) !!},
          peopleTags: {!! json_encode($phototags_people) !!},
          projects: {!! str_replace("'", "\'", json_encode($projects)) !!},
          phototypes: {!! json_encode($phototypes) !!},
          people: {!! json_encode($people) !!},
        },
        methods:{
          submitPhotograph(){
            axios.put('/photographs/'+this.photograph.id, this.photograph).then(response=>console.log(response.data));
          },
          addPersonTag(){
            if (this.personSelected !== null){
              let payload = {'person' : this.personSelected, 'photograph': this.photograph };
              axios.post('/phototags', payload)
              .then(response=>this.peopleTags.push(response.data))
              .then(this.personSelected=null)
              .then(this.$refs.mySelect.$refs.search.focus())
              ;
            }
          },
          deletePersonTag(id,key){
            axios.delete('/phototags/'+id)
                  .then(this.peopleTags.splice(key,1));
          },
          addPhotographer(){
            var id = this.photograph.photographer.id;
            this.photograph.photographer_person_id = id;
            this.submitPhotograph();
          },
          submitProjectTag(){
            let payload = {'projectTag' : this.projectTag, 'photograph': this.photograph };
            if(this.projectTag.id > 0){
              axios.put('/phototags/' + this.projectTag.id, payload);
            } else {
              axios.post('/phototags', payload)
              .then(response=>this.projectTag.id=response.data.id);
            }
          },
          deletePhotograph(){
            var txt;
            var r = confirm("Please confirm with OK that you want to delete this picture.");
            if (r == true) {
              axios.delete('/photographs/'+this.photograph.id);
              window.open('', '_self', '');
              window.close();
            }
          }
        }
      })
    </script>
  </body>
</html>
