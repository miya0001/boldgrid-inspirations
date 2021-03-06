<?php

/**
 * BoldGrid Source Code
 *
 * @package Boldgrid_Inspiration_File
 * @copyright BoldGrid.com
 * @version $Id$
 * @author BoldGrid.com <wpb@boldgrid.com>
 *        
 */

// Prevent direct calls
if ( ! defined( 'WPINC' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

/**
 * BoldGrid File Class
 */
class Boldgrid_Inspiration_File {
	/**
	 *
	 * @link http://stackoverflow.com/questions/1334613/how-to-recursively-zip-a-directory-in-php
	 *      
	 * @param unknown $source        	
	 * @param unknown $destination        	
	 * @return boolean
	 */
	public function zip( $source, $destination, $include_dir = true ) {
		if ( ! extension_loaded( 'zip' ) || ! file_exists( $source ) ) {
			die( "you do not have the zip extension loaded" );
			return false;
		}
		
		if ( file_exists( $destination ) ) {
			unlink( $destination );
		}
		
		$zip = new ZipArchive();
		if ( ! $zip->open( $destination, ZIPARCHIVE::CREATE ) ) {
			return false;
		}
		$source = str_replace( '\\', '/', realpath( $source ) );
		
		if ( is_dir( $source ) === true ) {
			
			$files = new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $source ), 
				RecursiveIteratorIterator::SELF_FIRST );
			
			if ( $include_dir ) {
				
				$arr = explode( "/", $source );
				$maindir = $arr[count( $arr ) - 1];
				
				$source = "";
				for ( $i = 0; $i < count( $arr ) - 1; $i ++ ) {
					$source .= '/' . $arr[$i];
				}
				
				$source = substr( $source, 1 );
				
				$zip->addEmptyDir( $maindir );
			}
			
			foreach ( $files as $file ) {
				$file = str_replace( '\\', '/', $file );
				
				// Ignore "." and ".." folders
				if ( in_array( substr( $file, strrpos( $file, '/' ) + 1 ), 
					array (
						'.',
						'..' 
					) ) )
					continue;
				
				$file = realpath( $file );
				
				if ( is_dir( $file ) === true ) {
					$zip->addEmptyDir( str_replace( $source . '/', '', $file . '/' ) );
				} else if ( is_file( $file ) === true ) {
					$zip->addFromString( str_replace( $source . '/', '', $file ), 
						file_get_contents( $file ) );
				}
			}
		} else if ( is_file( $source ) === true ) {
			$zip->addFromString( basename( $source ), file_get_contents( $source ) );
		}
		
		return $zip->close();
	}
	
	/**
	 * Pass this function an absolute path to a directory.
	 * It will scan the directory and return info about the file last updated.
	 *
	 * @param unknown $dir        	
	 * @return Ambigous <number, string, unknown>
	 */
	public function oldest_file_timestamp_in_directory( $dir ) {
		$greatest['time'] = 0;
		$greatest['file'] = '';
		$result = scandir( $dir );
		
		foreach ( $result as $k => $v ) {
			// if we're dealing with . or .., continue
			if ( in_array( $v, array (
				".",
				".." 
			) ) ) {
				continue;
			}
			
			// if this is a file
			$full_path = $dir . '/' . $v;
			if ( is_file( $full_path ) ) {
				// get the timestamp of this file
				$files_unix_time = filemtime( $dir . '/' . $v );
				// if it's the oldest file, keep track of it
				if ( $files_unix_time > $greatest['time'] ) {
					$greatest['time'] = $files_unix_time;
					$greatest['file'] = $full_path;
				}
			} elseif ( is_dir( $full_path ) ) {
				$directorys_greatest = $this->oldest_file_timestamp_in_directory( $full_path );
				if ( $directorys_greatest['time'] > $greatest['time'] ) {
					$greatest['time'] = $directorys_greatest['time'];
					$greatest['file'] = $directorys_greatest['file'];
				}
			}
		}
		
		return $greatest;
	}
}

