@extends('dashboard.layout.app')
@section('content')

<div class="container-fluid main-content settings px-2 px-lg-4">
        <!-- Tables -->
        <div class="row my-2 g-3 g-lg-4 pb-3 settings-inner">
          <div class="col-sm-6 col-lg-5 col-xl-4 col-xxl-3">
            <div class="profile">
              <div class="profile-img">
                <img style="border-radius: 50%" width="150" height="150" src="{{ asset($user->avatar ?? 'img/trader.jpg') }}" alt="">
              </div>
              <h4 class="text-white fw-semibold text-center mt-3 mb-1">{{ $user->name }}</h4>

            </div>
          </div>
          <div class="col-sm-6 col-lg-7 col-xl-8 col-xxl-9">
               @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
            <div class="settings-tab">
              <ul class="nav nav-pills" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-selected="true">Profile</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pills-password-tab" data-bs-toggle="pill" data-bs-target="#pills-password" type="button" role="tab" aria-selected="false">Change Password</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pills-login-tab" data-bs-toggle="pill" data-bs-target="#pills-login" type="button" role="tab" aria-selected="false">Login Device History</button>
                </li>
              </ul>

              <div class="tab-content pt-2" id="pills-tabContent">
                <div class="tab-pane fade active show" id="pills-profile" role="tabpanel" tabindex="0">
                  <form action="{{ route('user.updateProfile', $user->id) }}" method="POST" enctype="multipart/form-data">
                      @csrf

                    <div class="row">
                      <div class="col-md-12">
                        <label class="fw-semibold mb-2 mt-3" for="fname">Full Name</label>
                        <input type="text" id="fname" name="name" value="{{ old('name', $user->name) }}" class="form-control">
                      </div>
                      <div class="col-md-6">
                        <label class="fw-semibold mb-2 mt-3" for="email">Email Address</label>
                        <input type="text" id="email" name="email" readonly value="{{ old('email', $user->email) }}" class="form-control">
                      </div>
                      <div class="col-md-6">
                        <label class="fw-semibold mb-2 mt-3" for="phone">Phone Number</label>
                        <input type="text" id="phone" name="phone"  value="{{ old('phone', $user->phone) ?? '' }}" class="form-control">
                      </div>
                        <div class="col-md-6">
                        <label class="fw-semibold mb-2 mt-3" for="phone">Telegram Username</label>
                        <input type="text" id="phone" name="telegram"  value="{{ old('telegram', $user->telegram) ?? '' }}" class="form-control">
                      </div>
                      <div class="col-md-6">
                        <label class="fw-semibold mb-2 mt-3" for="city">Address</label>
                        <input type="text" id="city" name="address" value="{{ old('address', $user->address) ?? '' }}" class="form-control">
                      </div>
                        <div class="col-md-6">
                        <label class="fw-semibold mb-2 mt-3" for="city">City</label>
                        <input type="text" id="city" name="city" value="{{ old('city', $user->city) ?? '' }}" class="form-control">
                      </div>
                      <div class="col-md-6">
                        <label class="fw-semibold mb-2 mt-3" for="country">Country </label>
                        <input type="text" id="country" name="country" placeholder="Country ........" class="form-control">
                      </div>
                        <div class="col-md-6">
                        <label class="fw-semibold mb-2 mt-3" for="country">Profit Picture </label>
                        <input type="file" id="country" name="avatar" class="form-control">
                      </div>
                      <div class="col-12">

                        <div class="mt-4 d-flex gap-3">
                          <button type="submit" class="primary-btn-lg">Update</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="tab-pane fade" id="pills-password" role="tabpanel" tabindex="0">
                  <form action="{{ route('user.updatePassword') }}" method="POST">
                      @csrf
                    <div class="row">
                      <div class="col-md-6">
                        <label class="fw-semibold mb-2 mt-3" for="password">Current Password</label>
                        <input type="text" id="password" name="current_password" placeholder="Current Password........" class="form-control">
                      </div>
                      <div class="col-md-6">
                        <label class="fw-semibold mb-2 mt-3" for="newpass">New Password</label>
                        <input type="text" id="newpass" name="new_password" placeholder="New Password........" class="form-control">
                      </div>
                      <div class="col-md-6">
                        <label class="fw-semibold mb-2 mt-3" for="confirmpass">Confirm Password</label>
                        <input type="text" id="confirmpass" name="confirm_new_password" placeholder="Confirm Password........" class="form-control">
                      </div>
                      <div class="col-md-6 d-flex align-items-end">
                        <button class="primary-btn-lg mt-3" type="submit">Update Password</button>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="tab-pane fade" id="pills-login" role="tabpanel" tabindex="0">
                  <div class="recent-contact pb-2 pt-3">
                    <h5 class="fw-semibold">Login Device History</h5>
                    <table>
                      <thead>
                            <tr>
                                <th>ID</th>
                                <th>IP Address</th>
                                <th>User Agent</th>
                                <th>Last Activity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sessions as $index => $session)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $session->ip_address ?? 'N/A' }}</td>
                                    <td>{{ Str::limit($session->user_agent, 50) ?? 'N/A' }}</td>
                                    <td>{{ date('d M, Y H:i:s', $session->last_activity) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Footer -->
        <div class="row py-2 g-3 g-lg-4 top-border footer">
          <div class="col-lg-6">
            <span class="text-center text-lg-start d-block w-100">Copyright © 2023. All Rights Reserved By
              <a href="#" class="primary">CryptDash</a></span>
          </div>
          <div class="col-lg-6">
            <ul class="d-flex gap-2 gap-xl-4 p-0 align-items-center flex-wrap justify-content-center justify-content-lg-end">
              <li><a href="#">Help Center</a></li>
              <li><a href="#">Privacy</a></li>
              <li><a href="#">Terms of Service</a></li>
            </ul>
          </div>
        </div>
      </div>

@endsection
