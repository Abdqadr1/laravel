
<template>
  <nav class="navbar navbar-expand-lg bg-white border-bottom py-0">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="images/adilo.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
        Adilo
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse my-0 py-0" id="navbarNavDropdown">
        <ul class="navbar-nav mx-auto my-0 py-0 my-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">Project</a>
          </li>
          <li class="nav-item dropdown my-0 py-0">
            <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Tools & App
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Snapbyte Recorder</a></li>
              <hr class="my-1" />
              <li><a class="dropdown-item" href="#">AudioBounce</a></li>
              <hr class="my-1" />
              <li><a class="dropdown-item" href="#">Sugar Voice</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Channels</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contacts</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Analytics</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Settings</a>
          </li>

        </ul>
        <ul class="d-flex navbar-nav align-items-center me-4">
          <li class="nav-item">
            <a class="nav-link fw-bold" href="#">Help</a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex justify-content-start align-items-center" href="#">
              <img src="images/profile.png" alt="profile" width="35" height="35" class="me-2" />
              <div>
                <span class="d-block mb-1" style="font-size: small;line-height:1;">Cody Fisher</span>
                <span class="d-block" style="font-size: xx-small;line-height:1;">codyfisher@gmai.com</span>
              </div>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- content -->
  <div class="content">
    <div class="row mx-0 justify-content-center" v-show="isRecording">
      <div class="col-8 pt-4">
        <p class="mb-2 fs-6 d-flex align-items-center">
          <iconify-icon class="text-danger me-2" icon="ph:record-fill"></iconify-icon>Live Preview
        </p>
        <video class="video" src autoplay playsinline id="video"></video>
        <button type="button" disabled class="btn btn-primary mx-auto d-block mt-3">Start Recording</button>
      </div>
    </div>
    <div class="row mx-0 justify-content-center" v-show="!isRecording">
      <div class="col-2 border-end border-secondary py-4 px-2" style="background: #EBF2F6 0% 0% no-repeat padding-box;">
        <div class="d-flex justify-content-center align-items-center p-2 rounded mt-3"
          style="background: #E2E5ED 0% 0% no-repeat padding-box;">
          <iconify-icon class="me-4" icon="zondicons:film"></iconify-icon>
          <span style="color: #21455E;">My Recording</span>
        </div>
        <div class="d-flex justify-content-center align-items-center p-2 rounded mt-3">
          <iconify-icon class="me-4" icon="material-symbols:share-outline"></iconify-icon>
          <span style="color: #21455E;">Requested</span>
        </div>
      </div>
      <div class="col-10 py-2 px-5">
        <div class="my-2" style="font-size: 14px">
          <small>Snapbyte</small>
          <iconify-icon class="mx-2" style="font-size: 10px;"
            icon="material-symbols:arrow-forward-ios-rounded"></iconify-icon>
          <small>My Recordings</small>
        </div>
        <div class="d-flex justify-content-between">
          <div class="fs-4">My Recording: <b style="color: #637C8E;">{{ list.length }}</b></div>
          <div class="d-flex align-items-center head">
            <button class="btn btn-outline-secondary rounded btn-sm flex"><iconify-icon
                icon="lucide:arrow-up-down"></iconify-icon> By Date</button>
            <button class="btn btn-outline-secondary rounded btn-sm flex"><iconify-icon
                icon="material-symbols:filter-alt-outline"></iconify-icon> Add Filter</button>
            <button class="btn btn-primary rounded btn-sm flex"><iconify-icon
                icon="material-symbols:video-camera-back-outline"></iconify-icon> New Request</button>
            <button class="btn btn-danger rounded btn-sm flex" data-bs-toggle="modal" data-bs-target="#exampleModal">
              <iconify-icon icon="mdi:record-rec"></iconify-icon> Start Recording
            </button>
          </div>
        </div>
        <div v-if="emptyList">
          <div class="py-4 rounded border mt-3 border-dash">
            <div class="d-flex justify-content-center my-4">
              <img src="images/empty.png" width="220" height="170" alt="no record">
            </div>
            <div class="text-center">
              <p class="fw-bold">Say hello to the world!</p>
              <p class="mx-auto my-3" style="max-width: 500px;">Record your first video/audio and share it what your
                team, friends, followers and customers.</p>
            </div>
            <div class="d-flex align-items-center head justify-content-center">
              <button class="btn btn-primary rounded btn-sm flex"><iconify-icon
                  icon="material-symbols:video-camera-back-outline"></iconify-icon>New Request</button>
              <button class="btn btn-danger rounded btn-sm flex" data-bs-toggle="modal"
                data-bs-target="#exampleModal"><iconify-icon icon="mdi:record-rec"></iconify-icon>Start
                Recording</button>
            </div>
          </div>
          <div class="d-flex align-items-center head justify-content-center my-4">
            <img src="images/adilo1.png" alt="adilo1" />
            <div class="text-center ms-3">
              <p class="fw-bold fs-5 text-start" style="max-width: 400px;">Want more controls & better quality
                recording?</p>
              <button class="btn btn-primary rounded me-auto d-block">Download the desktop recorder</button>
            </div>
          </div>
        </div>
        <div v-else>
          <table class="table my-5 table-borderless">
            <thead>
              <tr>
                <th scope="col">Recordings</th>
                <th scope="col">Title</th>
                <th scope="col">View</th>
                <th scope="col">Size</th>
                <th scope="col">Last Modified</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(record, index) in list" :key="index">
                <td>
                  <div class="img">
                    <img :src="record.image" :alt="record.title" />
                    <span class="time bg-dark text-light">00.45</span>
                  </div>
                </td>
                <td style="max-width: 170px;line-height:1;">
                  <p class="mb-3">{{ record.title }}</p>
                  <small class="">{{ record.summary }}</small>
                </td>
                <td>{{ record.views }}</td>
                <td>{{ record.size }}</td>
                <td>{{ record.lastModified }}</td>
                <td style="color: #637C8E;">
                  <iconify-icon icon="ph:dots-three-outline-fill"></iconify-icon>
                </td>
              </tr>

            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="modal fade" tabindex="-1" id="exampleModal" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title fw-bold">New Recording</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <p v-if="errorMessage" class="text-center text-danger mt-3">{{ errorMessage }}</p>

          <div class="modal-body px-4 py-3">
            <p>Save the recording in</p>
            <select class="form-select mb-3" aria-label="Default select example" disabled>
              <option selected disabled>Select a project</option>
            </select>
            <div class="d-flex align-items-center justify-content-between mb-3">
              <span>Record screen</span>
              <div class="form-check form-switch">
                <input id="screen" class="form-check-input" type="checkbox" role="switch" @change="toggleSwitch">
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between mb-3">
              <span>Record camera</span>
              <div class="form-check form-switch">
                <input id="camera" class="form-check-input" type="checkbox" role="switch" @change="toggleSwitch">
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between mb-5">
              <span>Record mic</span>
              <div class="form-check form-switch">
                <input id="mic" class="form-check-input" type="checkbox" role="switch" @change="toggleSwitch">
              </div>
            </div>
            <button type="button" class="btn btn-primary mx-auto d-block mt-3 px-5" @click="startRecording">Start
              Recording</button>
          </div>
          <button type="button" ref="closeModalBtn" class="btn btn-secondary visually-hidden" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { LIST } from './list';
import Recorder from './recorder';

export default {
  data() {
    return {
      screen: false,
      camera: false,
      mic: false,
      errorMessage: '',
      isRecording: false,
      list: []
    }
  },
  watch: {
    // whenever question changes, this function will run
    isRecording(newValue) {
      if (newValue) {
        Recorder.record('video', this.screen, this.camera, this.mic);
        this.closeModal();
      }
    }
  },

  // Methods are functions that mutate state and trigger updates.
  // They can be bound as event listeners in templates.
  methods: {
    toggleSwitch(e) {
      const id = e.target.id;
      const checked = e.target.checked;
      this[id] = checked;
    },
    startRecording() {
      if (this.screen || this.camera) {
        this.isRecording = true;
      } else {
        this.errorMessage = 'Pick at least one video device';
      }
    },
    sleep(delay = 0) {
      return new Promise((resolve) => {
        setTimeout(resolve, delay);
      });
    },
    closeModal() {
      this.$refs.closeModalBtn.click();
    }
  },
  computed: {
    emptyList() {
      return this.list.length === 0;
    }
  },

  // Lifecycle hooks are called at different stages
  // of a component's lifecycle.
  // This function will be called when the component is mounted.
  mounted() {
    (async () => {
      await this.sleep(5e3); // For demo purposes.

      console.log('after 5 seconds');
      this.list = LIST;
    })();
  }
}
</script>