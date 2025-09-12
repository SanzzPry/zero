document.addEventListener("DOMContentLoaded", function () {
  let provinsi = document.getElementById("provinsi")
  let kabupaten = document.getElementById("kota")
  let kecamatan = document.getElementById("kecamatan")

  if (!provinsi || !kabupaten || !kecamatan) return

  let provinsiName = document.getElementById("provinsi_name")
  let kotaName = document.getElementById("kota_name")
  let kecamatanName = document.getElementById("kecamatan_name")

  // Data lama dari profile

  // 1. Load provinsi
  fetch("/provinsi")
    .then((res) => res.json())
    .then((data) => {
      data.forEach((p) => {
        let selected = p.id == oldProvinceId ? "selected" : ""
        provinsi.innerHTML += `<option value="${p.id}" ${selected}>${p.name}</option>`
      })

      if (oldProvinceId) {
        provinsiName.value = provinsi.options[provinsi.selectedIndex].text
        loadKabupaten(oldProvinceId)
      }
    })

  // 2. Load kabupaten
  function loadKabupaten(provinceId) {
    fetch(`/kabupaten/${provinceId}`)
      .then((res) => res.json())
      .then((data) => {
        data.forEach((k) => {
          let selected = k.id == oldCityId ? "selected" : ""
          kabupaten.innerHTML += `<option value="${k.id}" ${selected}>${k.name}</option>`
        })

        if (oldCityId) {
          kotaName.value = kabupaten.options[kabupaten.selectedIndex].text
          loadKecamatan(oldCityId)
        }
      })
  }

  // 3. Load kecamatan
  function loadKecamatan(cityId) {
    fetch(`/kecamatan/${cityId}`)
      .then((res) => res.json())
      .then((data) => {
        data.forEach((d) => {
          let selected = d.id == oldDistrictId ? "selected" : ""
          kecamatan.innerHTML += `<option value="${d.id}" ${selected}>${d.name}</option>`
        })

        if (oldDistrictId) {
          kecamatanName.value = kecamatan.options[kecamatan.selectedIndex].text
        }
      })
  }

  // 4. Event handler normal (kalau user ganti manual)
  provinsi.addEventListener("change", function () {
    kabupaten.innerHTML = "<option value=''>-- Pilih Kota/Kabupaten --</option>"
    kecamatan.innerHTML = "<option value=''>-- Pilih Kecamatan --</option>"
    provinsiName.value = this.options[this.selectedIndex].text
    if (this.value) loadKabupaten(this.value)
  })

  kabupaten.addEventListener("change", function () {
    kecamatan.innerHTML = "<option value=''>-- Pilih Kecamatan --</option>"
    kotaName.value = this.options[this.selectedIndex].text
    if (this.value) loadKecamatan(this.value)
  })

  kecamatan.addEventListener("change", function () {
    kecamatanName.value = this.options[this.selectedIndex].text
  })
})
