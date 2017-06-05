<?php

namespace Bookkeeper\Http\Controllers;


use Illuminate\Http\Request;
use Bookkeeper\Http\Controllers\Traits\UsesProfileForms;

class ProfileController extends BookkeeperController
{

    use UsesProfileForms;

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $profile = $this->getProfile();

        $form = $this->getEditProfileForm($profile);

        return $this->compileView('profile.edit', compact('form', 'profile'), trans('users.update_profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $profile = $this->getProfile();

        $this->validateUpdateProfile($request, $profile);

        $profile->update($request->all());

        $this->notify('users.updated_profile');

        return redirect()->route('bookkeeper.profile.edit');
    }

    /**
     * Show the form for updating password.
     *
     * @return Response
     */
    public function password()
    {
        $profile = $this->getProfile();

        $form = $this->getPasswordForm();

        return $this->compileView('profile.password', compact('form', 'profile'), trans('users.change_password'));
    }

    /**
     * Update users password
     *
     * @param Request $request
     * @return Response
     */
    public function updatePassword(Request $request)
    {
        $profile = $this->getProfile();

        $this->validateForm('Bookkeeper\Html\Forms\Users\PasswordForm', $request);

        $profile->setPassword($request->input('password'))->save();

        $this->notify('users.changed_password');

        return redirect()->route('bookkeeper.profile.password');
    }

    /**
     * Returns the currently logged in user
     *
     * @return User
     */
    protected function getProfile()
    {
        return auth()->user();
    }

}
